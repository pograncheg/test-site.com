<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/main.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <!-- <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script> -->
    <script src="../js/jquery-3.7.1.min.js"></script>
    <!-- <link href="css/style.css" rel="stylesheet"> -->
    <title><?= $title ?? 'Title' ?></title>

</head>

<body>
<div class="wrapper">
        <header class="header">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="container-fluid">
                    <a class="navbar-brand" href="/">SITE</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Переключатель навигации">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="/">Главная</a>
                            </li>
                            <!-- <li class="nav-item">
                                <a class="nav-link" href="/views/contact.php">Контакты</a>
                            </li> -->
                            <?php if (isset($_SESSION['user'])): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="/views/profile.php">Профиль</a>
                            </li>
                            <?php endif; ?>
                        </ul>
                        <ul class="d-flex text-white align-items-center list-unstyled m-0 gap-3">
                            <?php if (isset($_SESSION['user'])): ?>
                                <li style="color:limegreen;"><?= 'Hello ' . $_SESSION['user']['login']; ?></li>
                                <li><a class="nav-link" href="../handlers/logout-handler.php">Выход</a></li>
                            <?php else: ?>
                                <li><a class="nav-link" href="../views/register.php">Регистрация</a></li>
                                <li><a class="nav-link" href="../views/login.php">Вход</a></li>
<!-- 
                                <li><a class="nav-link" href="register.tpl.php">Регистрация</a></li>
                                <li><a class="nav-link" href="login.tpl.php">Вход</a></li> -->
                            <?php endif; ?>
                        </ul>
                        <!-- <form class="d-flex" role="search">
                            <input class="form-control me-2" type="search" placeholder="Поиск" aria-label="Поиск">
                            <button class="btn btn-outline-success" type="submit">Поиск</button>
                        </form> -->
                    </div>
                </div>
            </nav>
        </header>
