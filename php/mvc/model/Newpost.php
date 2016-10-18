<?php

namespace mvc\model;

class Newpost extends Model {

    public function __construct($postTitle, $postContent) {

// run constructor in Model
        parent::__construct();

        $query = "INSERT INTO posts  set
            post_title=:postTitle,
            post_content=:postContent;";
        $postContent = addslashes($postContent);
        $postContent = str_replace("\n", "<br/>", $postContent);

        ($this->prepare($query, array(
                    ':postTitle' => $postTitle,
                    ':postContent' => $postContent)));
    }

}

?>
