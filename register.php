<?php

require "head.php";

require "header.php";

?>

<form id="registerForm" method="post" action="">

    <div class="form-group">
        <label for="login">Логин</label>
        <input type="text" name="login" class="form-control" id="login" aria-describedby="emailHelp">
    </div>
    <div class="form-group">
        <label for="password">Пароль</label>
        <input type="password" name="password" class="form-control" id="password">
    </div>
    <button type="submit" class="btn btn-primary">Регистрация</button>
</form>

<?
require "footer.php";

?>