<?php
    require_once('./Models/Post.php');

    class PostController {
        public static function getAll() {
            return Post::getAll();
        }

        public static function getPost($iId) {
            return Post::getOne($iId);
        }

        public static function store() {
            $oPost = new Post();
            $oPost->title = $_POST['title'];
            $oPost->content = addslashes($_POST['content']);
            $oPost->user_id = $_SESSION['user_id'];
            $oPost->created_at = date('Y-m-d H:i:s');
            $oPost->save();
            return $oPost;
        }
    }
?>