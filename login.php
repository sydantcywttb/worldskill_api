<?php

require "head.php";

global $DB, $RESULT;

$err = false;

if (isset($_POST['method']) && $_POST['method'] == 'login') {

    $login = $_POST['login'];
    $password = $_POST['password'];

    $isFound = false;
    foreach ($RESULT['users'] as $user) {
        if ($user['login'] == $login && $user['password'] == $password) {

            $isFound = true;

            setcookie('USER', json_encode($user));
            header('Location: /');
            break;
        }
    }

    if(!$isFound) {
        $err = 'User did not find or password is not right';
    }

}

require "header.php";

if($err) {
    showError($err);
}
?>

<form method="post" action="">
    <input type="hidden" name="method" value="login">

    <input type="text" name="login" placeholder="Login">
    <input type="password" name="password" placeholder="Password">
    <input type="submit" value="Login">
</form>

<?
require "footer.php";

?>