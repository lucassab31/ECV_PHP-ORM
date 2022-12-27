<?php
    require_once('./Models/Post.php');

    class PostController {
        public static function getAll() {
            return Post::getAll();
        }
    }
?>