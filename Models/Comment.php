<?php
    require_once('./Models/Table.php');
    require_once('./Models/Post.php');

    class Comment extends Table {

        public static $table_name = 'comments';
        public static $primary_key_field_name = 'id_comment';
        public static $fields_names = ['post_id', 'content', 'user', 'created_at'];

        public function __construct() {
            // $table_name = 'posts';
            // $primary_key_field_name = 'id_comment';
            // $fields_names = ['post_id', 'content', 'user', 'created_at'];
            // parent::__construct($table_name, $primary_key_field_name, $fields_names);
        }

        public function hydrate() {
            parent::hydrate();
        }

    }
?>