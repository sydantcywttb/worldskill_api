<?php

require "head.php";

if(!$USER) {
    header('Location: /login.php');
}
require "header.php";

?>

    <h1>Приветсвуем вас на сайте</h1>
<?
require "footer.php";

?>