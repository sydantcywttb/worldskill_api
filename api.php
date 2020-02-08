<?php

$RESULT = [];

$DB = new PDO('mysql:host=localhost;dbname=worldapi', 'mysql', 'mysql');


function getUsers() {
    global $DB;

    $query = $DB->prepare('SELECT * FROM users ');
    $query->execute();
    $rows = $query->fetchAll(PDO::FETCH_ASSOC);

    return $rows;
}

$RESULT['users'] = getUsers();

if(isset($_GET['api'])) {
    if($_GET['api'] === 'all') {

        header('HTTP/1.1 200 OK');
        header('Content-Type: application/json;');
        print_r(json_encode($RESULT));
    }
}



if(isset($_POST['api'])) {
    header('HTTP/1.1 200 OK');
    header('Content-Type: application/json;');

    if($_POST['api'] === 'update') {

        $sqlToInsert = [
            'users' => 'INSERT INTO users (login, password, created_at) VALUES (:login, :password, :created_at)',
        ];

        $sqlToUpdate = [
            'users' => 'UPDATE users SET login=:login, password=:password, updated_at = :updated_at WHERE id=:id',
        ];


        $data = json_decode($_POST['data'], true);
        if(isset($data) && is_array($data)) {
            foreach ($data as $tableName => $rows) {

                foreach ($rows as $row) {

                    if(isset($row['created_at']) && $row['created_at'] === 1) {
                        $row['created_at'] = mktime();

                        $sql = $DB->prepare($sqlToInsert[$tableName]);
                        $result = $sql->execute($row);
                    }

                    if(isset($row['updated_at']) && $row['updated_at'] === 1) {
                        $row['updated_at'] = mktime();
                        $sql = $DB->prepare($sqlToUpdate[$tableName]);
                        $result = $sql->execute($row);
                    }


                }
            }
        }
        print_r(json_encode(['status' => true]));
    }
}