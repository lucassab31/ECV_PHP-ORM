<?php
    require_once('./Models/Table.php');
    require_once('./Models/Comment.php');
    require_once('./Models/Post.php');

    class Comment extends Table {

        public function __construct() {
            $table_name = 'posts';
            $primary_key_field_name = 'id';
            $fields_names = ['title', 'description', 'created', 'modifed', 'is_user'];
            parent::__construct($table_name, $primary_key_field_name, $fields_names);
        }

        public function hydrate() {
            parent::hydrate();
            $this->post = Post::getOne($this->id_post);
            $this->user = User::getOne($this->id_user);
        }
    }
?>