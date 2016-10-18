<?php

namespace mvc\model;

use PDO;
use PDOStatement;
use PDOException;

class Model {

    protected $db = null;
    private $ps = null;
    private $eventmsg = "";
    private $error = "";
    private $errorMessage = "Book Shop is currently unavailable. Please visit us again soon.";
    private $row = null;
    private $rowCount = 0;
    private $colCount = 0;

    public function __construct() {
        $this->db = null;

        try {

            if ($_SERVER['HTTP_HOST'] == 'localhost') {
                $database = "OnlineBookShop";
                $username = "root";
                $password = "";
            } else {
                $database = 'amirfarc_OnlineBookShop';
                $username = 'amirfarc_obs';
                $password = 'mGjK42C5i';
            }

// connect to database, create a PDO object
// should be change for uploading
            $this->db = new PDO("mysql:host=localhost;dbname=$database", $username, $password);
// create an exception when there is an SQL error

            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $error) {
// error_log writes the error to an error log file       
            error_log($error->getMessage());
            $this->error = $this->errorMessage;
        }
    }

    protected function query($query) {
        try {
            if ($this->db) {
                $this->ps = $this->db->query($query);
                $this->rowCount = $this->ps->rowCount();
                $this->colCount = $this->ps->columnCount();
                
            }
        } catch (PDOException $error) {
// error_log writes the error to an error log file       
            error_log($error->getMessage());
            $this->error = $this->errorMessage;
        }
    }

    protected function execute($query) {
        try {
            if ($this->db) {
                $this->rowCount = $this->db->exec($query);
                
            }
        } catch (PDOException $error) {
            error_log($error->getMessage());
            $this->error = $this->errorMessage;
        }
    }

// prepare function
    protected function prepare($query, $parameters = null) {
        try {
            if ($this->db) {
                $this->ps = $this->db->prepare($query);
                if ($parameters) {
//                    foreach ($parameters as $placeholder => $value) {
                    $this->prepareBind($parameters);
                    //                 }
//                    $this->ps->execute();
                    //                 $this->rowCount = $this->ps->rowCount();
                }
            }
        } catch (PDOException $error) {
// error_log writes the error to an error log file       
            error_log($error->getMessage());
            $this->error = $this->errorMessage;
        }
    }

    protected function prepareBind($parameters = null) {
        foreach ($parameters as $placeholder => $value) {
            $this->ps->bindValue($placeholder, $value);
        }

        $this->ps->execute();

        $this->rowCount = $this->ps->rowCount();
    }

    protected function executePrepare($placeholder, $value) {
        try {
            if ($this->db) {
                $this->ps->bindValue($placeholder, $value);
                $this->ps->execute();
                $this->rowCount = $this->ps->rowCount();
            }
        } catch (PDOException $error) {
            error_log($error->getMessage());
            $this->error = $this->errorMessage;
        }
    }

    public function getRowCount() {
        return $this->rowCount;
    }
    public function getColCount() {
        return $this->colCount;
    }

    public function isDataReturned() {
        return ($this->rowCount > 0);
    }

    public function next() {
        $this->row = null;
// if $this->ps is null then      
        if ($this->ps)
            $this->row = $this->ps->fetch(PDO::FETCH_ASSOC);


        return $this->row;
    }

    protected function get($key) {
        return (isset($this->row[$key])) ? $this->row[$key] : "";
      
    }

// set an error
    protected function setError($error) {
        $this->error = $error;
    }

// return any error message
    public function getError() {
        return $this->error;
    }

    protected function setEventMsg($eventmsg) {
        $this->eventmsg = $eventmsg;
    }

// return any error message
    public function getEventMsg() {
        return $this->eventmsg;
    }

// destruct method executed when the object is garbage collected
// this will close the database connection
    public function __destruct() {
        $this->db = null;
    }

    public function getLastId() {
        return $this->db->lastInsertId();
    }

    public function startTransaction() {
        $this->db->beginTransaction();
    }

    public function commit() {
        $this->db->commit();
    }

    public function rollBack() {
        $this->db->rollBack();
    }

}

?>
