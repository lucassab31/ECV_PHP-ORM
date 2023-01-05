<?php
    require_once('./Models/Table.php');
    require_once('./Models/User.php');
    require_once('./Models/Comment.php');

    class Post extends Table {

        public static $primary_key_field_name = 'id_post';
        public static $table_name = 'posts';
        public static $fields_names = ['title', 'content', 'user_id', 'created_at'];

        public function __construct() {
            // $table_name = 'posts';
            // $primary_key_field_name = 'id_post';
            // $fields_names = ['title', 'content', 'user', 'created_at'];
            // parent::__construct($table_name, $primary_key_field_name, $fields_names);
        }

        public function hydrate() {
            parent::hydrate();
            $this->comments = Post::getComments();
            $this->user = User::getOne($this->user_id);
        }

        public function getComments() {
            $sSQL = 'SELECT id_comment FROM comments WHERE post_id = ' . $this->{static::$primary_key_field_name};
            $tData = my_fetch_array($sSQL);
            $tComments = [];
            foreach ($tData as $sComment) {
                $oComment = new Comment();
                $oComment->{Comment::$primary_key_field_name} = $sComment[0];
                $oComment->hydrate();
                $tComments[] = $oComment;
            }
            return $tComments;
        }
    }
?>