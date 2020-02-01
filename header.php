<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>WorldSkills</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/popper.min.js"></script>
</head>
<body>

<ul class="nav justify-content-center">
    <li class="nav-item">
        <a class="nav-link" href="/">Главная</a>
    </li>
    <? if ($USER): ?>
        <li class="nav-item">
            <a class="nav-link" href="/exit.php">Выход</a>
        </li>
    <? else: ?>
        <li class="nav-item">
            <a class="nav-link" href="/login.php">Вход</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/register.php">Регистрация</a>
        </li>
    <? endif; ?>
</ul>