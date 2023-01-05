<?php
    require_once('./Models/Comment.php');

    class CommentController {

        public static function getPost($iId) {
            return Post::getOne($iId);
        }

        public static function store() {
            $oComment = new Comment();
            $oComment->post_id = $_POST['post_id'];
            $oComment->content = addslashes($_POST['content']);
            $oComment->user_id = $_SESSION['user_id'];
            $oComment->created_at = date('Y-m-d H:i:s');
            $oComment->save();
            return $oComment;
        }
    }
?>