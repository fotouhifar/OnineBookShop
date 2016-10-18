<?php

namespace mvc\model;

class Blog extends Model {

    public function __construct() {
        parent::__construct();


        //*******************************************************************************      


        $query = "SELECT * FROM posts s ORDER BY post_id DESC";
// create a prepared statement 
        $this->prepare($query);
// test for no data
        //         $this->executePrepare();
        $this->executePrepare('a', 1);

        if (!$this->isDataReturned())
            $this->setError("No Post Found!");
    }

    public function getPostTitle() {
        return $this->get('post_title');
    }

    public function getPostImage() {
        return $this->get('post_img');
    }

    public function getPostContent() {
        return $this->get('post_content');
    }

    public function getPostId() {
        return $this->get('post_id');
    }

}

?>
