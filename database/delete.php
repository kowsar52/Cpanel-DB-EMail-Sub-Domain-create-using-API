<?php

require "../init.php";

// On posting the form
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $parameter = [
        'name' => $_POST['database']

    ];
    $result = $cPanel->execute('uapi', 'Mysql', 'delete_database', $parameter);
    if (!$result->status == 1) {
        setE("Cannot delete database : {$result->errors[0]}");
        header("location: /index.php");
        die();
    }
    setS("Database deletion successful.");
    header("location: /database/list.php");
    die();
}



// Database Listing
$result = $cPanel->execute("api2", "MysqlFE", "listdbs");

if (isset($result->cpanelresult->error)) {
    setE("Cannot list database: {$result->cpanelresult->error}");
    header("location: /index.php");
    die();
}


echo $twig->render("database/delete.twig" , ['result' => $result->cpanelresult->data ]);
clearMessages();
die();