<?php

require "head.php";

global $DB, $RESULT;

$err = false;

if (isset($_POST['method']) && $_POST['method'] == 'register') {

    $login = $_POST['login'];
    $password = $_POST['password'];

    $isFound = false;
    foreach ($RESULT['users'] as $user) {
        if ($user['login'] == $login) {

            $isFound = true;
            break;
        }
    }

    if($isFound) {
        $err = 'User found';
    } else {
        $sql = $DB->prepare('INSERT INTO users (login, password) VALUES (?, ?)');
        $result = $sql->execute([$login, $password]);
        if($result) {

            $sql = $DB->prepare('SELECT * FROM users WHERE login = ?');
            $sql->execute([$login]);
            $user = $sql->fetch();

            setcookie('USER', json_encode($user));
            header('Location: /');
        } else {
            $err = 'Error with register';
        }
    }

}

require "header.php";

if($err) {
    showError($err);
}
?>

<form method="post" action="">
    <input type="hidden" name="method" value="register">

    <input type="text" name="login" placeholder="Login">
    <input type="password" name="password" placeholder="Password">
    <input type="submit" value="Register">
</form>

<?
require "footer.php";

?>