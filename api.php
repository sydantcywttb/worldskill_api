<?php

$DB = new PDO('mysql:host=localhost;dbname=worldapi', 'mysql', 'mysql');

$tables = [
    'users' => ['login', 'password', 'created_at', 'updated_at', 'deleted_at'],
    'topics' => ['title', 'content', 'parent_id', 'level',
        'created_at', 'updated_at', 'deleted_at'],
];

$RESULT = [];
foreach ($tables as $tableName => $value) {
    $query = $DB->prepare("SELECT * FROM {$tableName} WHERE deleted_at = '0'");
    $query->execute();
    $RESULT[$tableName] = $query->fetchAll(PDO::FETCH_ASSOC);
}

if (isset($_GET['api']) && $_GET['api'] === 'all') {

    header('HTTP/1.1 200 OK');
    header('Content-Type: application/json;');
    print_r(json_encode($RESULT));
    die();
}

if (isset($_GET['api']) && $_GET['api'] === 'update_session') {

    header('HTTP/1.1 200 OK');
    header('Content-Type: application/json;');

    if (strlen($_GET['login']) > 1) {
        setcookie('login', $_GET['login'], time() + 60 * 60 * 30);
    } else {
        setcookie('login', '', time() - 60 * 60 * 30);
    }

    print_r(json_encode($RESULT));
    die();
}


if (isset($_POST['api']) && $_POST['api'] === 'update') {
    header('HTTP/1.1 200 OK');
    header('Content-Type: application/json;');

    $data = json_decode($_POST['data'], true);

    if (isset($data) && is_array($data)) {
        foreach ($data as $tableName => $rows) {

            foreach ($rows as $row) {
                if (isset($row['created_at']) && $row['created_at'] === 1) {
                    // create row

                    $row['created_at'] = mktime();

                    // prepare data
                    $fields = [];
                    $fieldKeys = [];
                    $fieldValues = [];
                    foreach ($tables[$tableName] as $columnName) {
                        if (isset($row[$columnName])) {
                            $fields[':' . $columnName] = $row[$columnName];
                            $fieldKeys[] = $columnName;
                            $fieldValues[] = ':' . $columnName;
                        }
                    }

                    // form sql
                    $strKeys = join(',', $fieldKeys);
                    $strValues = join(',', $fieldValues);
                    $strSql = "INSERT INTO {$tableName} ({$strKeys}) VALUES ({$strValues})";

                    $sql = $DB->prepare($strSql);
                    $result = $sql->execute($fields);
                }

                if (isset($row['updated_at']) && $row['updated_at'] === 1) {
                    // update row

                    $row['updated_at'] = mktime();

                    // prepare data
                    $fields = [];
                    $fieldKeys = [];
                    foreach ($tables[$tableName] as $columnName) {
                        if (isset($row[$columnName])) {
                            $fields[':' . $columnName] = $row[$columnName];
                            $fieldKeys[] = $columnName . '=' . ':' . $columnName;
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