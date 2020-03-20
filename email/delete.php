<?php

require "../init.php";


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $parameters = [
        'email' => explode("@", $_POST['email'])[0],
        'domain' => explode("@", $_POST['email'])[1],
    ];
    $result = $cPanel->execute('uapi', 'Email', 'delete_pop', $parameters);
    if (!$result->status == 1) {
        setE("Cannot Delete Email account : {$result->messages[0]} | {$result->errors[0]}");
        header("location: /index.php");
        die();
    }

    setS("Email account deletion successful");
    header("location: /email/list.php");
    die();
}




// Email account listing
$result = $cPanel->execute('uapi', 'Email', 'list_pops');
if (!$result->status == 1) {
    setE("Cannot fetch domains list : {$result->messages[0]} | {$result->errors[0]}");
    header("location: /index.php");
    die();
}

echo $twig->render("email/delete.twig" , ['result' => $result->data]);