<?php

require "../init.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $parameters = [
            'email' => $_POST['name'],
            'password' => $_POST['pass'],
            'domain' => $_POST['domain'],
            'quota' => $_POST['quota'],
    ];

    $result = $cPanel->execute('uapi', "Email", "add_pop", $parameters);
    if (!$result->status == 1) {
        setE("Cannot fetch domains list : {$result->messages[0]} | {$result->errors[0]}");
        header("location: /index.php");
        die();
    }

    setS("Email account creation successful");
    header("location: /email/list.php");
    die();
}


echo $twig->render("email/addemail.twig");
clearMessages();
die();