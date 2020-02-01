<?php

$arResult = [];

$DB = new PDO('mysql:host=localhost;dbname=worldapi', 'mysql', 'mysql');


function getUsers() {
    global $DB;

    $query = $DB->prepare('SELECT * FROM users ');
    $query->execute();

    $rows = $query->fetchAll(PDO::FETCH_ASSOC);

    return $rows;
}

$arResult['USERS'] = getUsers();

if(isset($_POST['api']) || isset($_GET['api'])) {

    header('HTTP/1.1 200 OK');
    header('Content-Type: application/json;');
    print_r(json_encode($arResult));
}