<?php session_start();
    if (!isset($_GET['page']))
        $sPage = 'home';
    else {
        $sPage = $_GET['page'];
        if (!isset($_GET['id']))
            $iId = 0;
        else
            $iId = $_GET['id'];
    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skyblog :)</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Playfair&#43;Display:700,900&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./public/css/style.css">
</head>
<body class="container">
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="/">Skyblog</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link <?= ($sPage == 'home' ? 'active' : '') ?>" href="?">Accueil</a>
                        </li>
                        <?php
                            if (isset($_SESSION['user_id'])) {
                                ?>
                                <li class="nav-item">
                                    <a class="nav-link <?= ($sPage == 'post-add' ? 'active' : '') ?>" href="?page=post-add">Ajouter un post</a>
                                </li>
                                <?php
                            } else {
                                ?>
                                <li class="nav-item">
                                    <a class="nav-link <?= ($sPage == 'user-login' ? 'active' : '') ?>" href="?page=login">Connexion</a>
                                </li>
                                <?php
                            }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main class="mt-4">
        <?php
            if ($sPage == 'home') 
            {
                require_once('./Controllers/PostController.php');
                $tPosts = PostController::getAll();
                require_once('./Views/posts/index.php');
            }
            elseif ($sPage == 'post') 
            {
                if ($iId == 0) 
                    require_once('./Views/pages/undefined.php');
                else 
                {
                    require_once('./Controllers/PostController.php');
                    $oPost = PostController::getPost($iId);
                    require_once('./Views/posts/post.php');
                }
            }
            elseif ($sPage == 'post-add') 
            {
                require_once('./Views/posts/add.php');
            }
            elseif ($sPage == 'post-store') 
            {
                require_once('./Controllers/PostController.php');
                $oPost = PostController::store();
                header('Location: ?page=home');
            }
            elseif($sPage == 'comment-store'){
                require_once('./Controllers/CommentController.php');
                $oComment = CommentController::store();
                header('Location: ?page=post&id='.$oComment->post_id);
            }
            elseif($sPage == 'login'){
                require_once('./Views/auth/login.php');
            }
            elseif($sPage == 'user-login'){
                require_once('./Views/auth/login.php');
            }
            elseif($sPage == 'register'){
                require_once('./Views/auth/register.php');
            }
            elseif($sPage == 'user-store'){
                require_once('./Controllers/UserController.php');
                $oUser = UserController::store();
                header('Location: ?page=post-add');
                require_once('./Views/auth/register.php');
            }
            else 
            {
                require_once('./Views/pages/undefined.php');
            }
        ?>
    </main>
</body>
</html>