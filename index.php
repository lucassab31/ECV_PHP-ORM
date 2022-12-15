<?php
    if (!isset($_GET['page']))
        $sPage = 'home';
    else
        $sPage = $_GET['page'];

    if ($sPage == 'home') {
        require_once('./Controllers/PostController.php');
        $tPosts = PostController::getAll();
        require_once('./Views/posts/posts.php');
    }
?>