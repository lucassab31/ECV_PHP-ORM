<?php
    require_once('./Models/Table.php');

    class User extends Table {

        public function __construct() {
            $table_name = 'posts';
            $primary_key_field_name = 'id';
            $fields_names = ['title', 'description', 'created', 'modifed', 'is_user'];
            parent::__construct($table_name, $primary_key_field_name, $fields_names);
        }

        public function hydrate() {
            parent::hydrate();
            $this->posts = User::getPosts();
            $this->comments = User::getComments();
        }

        public function getPosts() {
            $sSQL = 'SELECT '.$this->{$this->primary_key_field_name}.' FROM posts WHERE id_user = ' . $this->{$this->primary_key_field_name};
            $tData = my_fetch_array($sSQL);
            $tPosts = [];
            foreach ($tData as $sPost) {
                $oPost = new Comment();
                $oPost->{$oPost->primary_key_field_name} = $sPost;
                $tPosts[] = $oPost->hydrate();
            }
            return $tPosts;
        }

        public function getComments() {
            $sSQL = 'SELECT '.$this->{$this->primary_key_field_name}.' FROM comments WHERE id_user = ' . $this->{$this->primary_key_field_name};
            $tData = my_fetch_array($sSQL);
            $tComments = [];
            foreach ($tData as $sComment) {
                $oComment = new Comment();
                $oComment->{$oComment->primary_key_field_name} = $sComment;
                $tComments[] = $oComment->hydrate();
            }
            return $tComments;
        }
    }
?>