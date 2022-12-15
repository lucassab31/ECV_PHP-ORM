<?php
    require_once('./Models/Table.php');
    require_once('./Models/User.php');

    class Post extends Table {

        public function __construct() {
            $table_name = 'posts';
            $primary_key_field_name = 'id';
            $fields_names = ['title', 'description', 'created', 'modifed', 'is_user'];
            parent::__construct($table_name, $primary_key_field_name, $fields_names);
        }

        public function hydrate() {
            parent::hydrate();
            $this->comments = Post::getComments();
            $this->user = User::getOne($this->id_user);
        }

        public function getComments() {
            $sSQL = 'SELECT '.$this->{$this->primary_key_field_name}.' FROM comments WHERE id_post = ' . $this->{$this->primary_key_field_name};
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