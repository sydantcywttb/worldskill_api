<?php

require "head.php";

setcookie('USER', '', time() - 3600);
header('Location: /');

require "header.php";

?>

<h1>Сейчас вы будете перенаправлены на страницу выхода</h1>
<?
require "footer.php";

?>