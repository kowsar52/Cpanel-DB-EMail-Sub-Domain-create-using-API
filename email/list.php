<?php

require "../init.php";

$result = $cPanel->execute('uapi', 'Email', 'list_pops');
if (!$result->status == 1) {
    setE("Cannot fetch domains list : {$result->messages[0]} | {$result->errors[0]}");
    header("location: /index.php");
    die();
}

echo $twig->render("email/list.twig", ['result' => $result->data]);
clearMessages();
die();