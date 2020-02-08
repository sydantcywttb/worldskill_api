<?php

$RESULT = [];

$DB = new PDO('mysql:host=localhost;dbname=worldapi', 'mysql', 'mysql');


function getUsers() {
    global $DB;

    $query = $DB->prepare('SELECT * FROM users WHERE deleted_at = "0"');
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

        $tables = [
            'users' => [
                'login' => '',
                'password' => '',
                'created_at' => '',
                'updated_at' => '',
                'deleted_at' => '',
            ]
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

                        // prepare data
                        $fields = [];
                        $fieldKeys = [];
                        $fieldValues = [];
                        foreach ($tables[$tableName] as $key => $item) {
                            if(isset($row[$key])) {
                                $fields[':' . $key] = $row[$key];
                                $fieldKeys[] = $key;
                                $fieldValues[] = ':' . $key;
                            }
                        }

                        // form sql
                        $strKeys = join(',', $fieldKeys);
                        $strValues = join(',', $fieldValues);
                        $strSql = "INSERT INTO {$tableName} ({$strKeys}) VALUES ({$strValues})";

                        $sql = $DB->prepare($strSql);
                        $result = $sql->execute($fields);
                    }

                    if(isset($row['updated_at']) && $row['updated_at'] === 1) {
                        $row['updated_at'] = mktime();

                        // prepare data
                        $fields = [];
                        $fieldKeys = [];
                        foreach ($tables[$tableName] as $key => $item) {
                            if(isset($row[$key])) {
                                $fields[':' . $key] = $row[$key];
                                $fieldKeys[] = $key . '=' . ':' . $key;
                            }
                        }

                        // form sql
                        $strKeys = join(',', $fieldKeys);
                        $strSql = "UPDATE {$tableName} SET {$strKeys} WHERE id=:id";

                        $sql = $DB->prepare($strSql);
                        $result = $sql->execute($fields);
                    }


                }
            }
        }
        print_r(json_encode(['status' => true]));
    }
}