<?php

require "../init.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $parameter = [ 'name' => $_POST['database_name'] ];
    $result = $cPanel->execute('uapi', 'Mysql', 'create_database', $parameter);
    if (!$result->status == 1) {
        setE("Cannot create database : {$result->errors[0]}");
        header("location: /index.php");
        die();
    }
    setS("Database creation successful.");
    header("location: /database/list.php");
    die();
}


echo $twig->render("database/create.twig");
clearMessages();
die();