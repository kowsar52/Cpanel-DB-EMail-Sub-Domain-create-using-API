<?php


require "../init.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $parameters = [
        'domain' => $_POST['domain'],
        'rootdomain' => $_POST['root'],
        'dir' => $_POST['dir'],
        'disallowdot' => 1,
    ];
    $result = $cPanel->execute('api2',"SubDomain", "addsubdomain" , $parameters);
    if (isset($result->cpanelresult->error)) {
        setE("Cannot add sub domain : {$result->cpanelresult->error} ");
        header("location: /index.php");
        die();
    }
    setS("Sub domain added successfully");
    header("location: /domain/list.php");
    die();
}

echo $twig->render('domain/addsub.twig');
clearMessages();
die();