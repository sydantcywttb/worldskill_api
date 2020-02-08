<?php

require "head.php";

require "header.php";

?>

<form id="register" method="post" action="">
    <input type="hidden" name="method" value="register">

    <input type="text" name="login" placeholder="Login">
    <input type="password" name="password" placeholder="Password">
    <input type="submit" value="Register">
</form>

<?
require "footer.php";

?>