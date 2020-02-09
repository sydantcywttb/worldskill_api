<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>WorldSkills</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
</head>
<body>
<script>
    window.STORE = <? print_r(json_encode($RESULT))?>;
    window._GET = <?= json_encode($_GET)?>;
    window._POST = <?= json_encode($_POST)?>;

</script>
<div class="alerts"></div>

<nav class="navbar navbar-expand-lg navbar-light bg-light mb-3">
    <a class="navbar-brand" href="#">Форум</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="/">Главная</a>
            </li>
            <? if ($USER): ?>
                <li class="nav-item">
                    <a class="nav-link action-exit" href="#">Выход</a>
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
        <span class="navbar-text">
          <?if($USER):?>
            <?= $USER; ?>
            <?else:?>
          Гость
            <?endif;?>
        </span>
    </div>
</nav>
<div class="container">