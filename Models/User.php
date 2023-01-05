<?php
    require_once('./Models/Table.php');

    class User extends Table {

        public static $primary_key_field_name = 'id_user';
        public static $table_name = 'users';
        public static $fields_names = ['email', 'password'];

        public function hydrate() {
            parent::hydrate();
            // $this->posts = User::getPosts();
            // $this->comments = User::getComments();
        }

        public function getPosts() {
            $sSQL = 'SELECT id_post FROM posts WHERE user_id = ' . $this->{static::$primary_key_field_name};
            $tData = my_fetch_array($sSQL);
            $tPosts = [];
            foreach ($tData as $sPost) {
                $oPost = new Post();
                $oPost->{Post::$primary_key_field_name} = $sPost['id_post'];
                $oPost->hydrate();
                $tPosts[] = $oPost;
            }
            return $tPosts;
        }

        public function getComments() {
            $sSQL = 'SELECT id_comment FROM comments WHERE user_id = ' . $this->{static::$primary_key_field_name};
            $tData = my_fetch_array($sSQL);
            $tComments = [];
            foreach ($tData as $sComment) {
                $oComment = new Comment();
                $oComment->{$oComment->primary_key_field_name} = $sComment;
                $oComment->hydrate();
                $tComments[] = $oComment;
            }
            return $tComments;
        }

        public static function getOneByMail($sEmail) {
            $sSQL = 'SELECT * FROM '.static::$table_name.' WHERE email = "'.$sEmail.'"';
            $tData = my_fetch_array($sSQL);
            if (count($tData) == 0) {
                return false;
            }
            $oUser = new User();
            $oUser->id_user = $tData[0]['id_user'];
            $oUser->hydrate();
            return $oUser;
        }
    }
?>