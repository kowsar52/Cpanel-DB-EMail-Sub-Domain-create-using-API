<?php
require "../init.php";




// If form is posted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $parameters = [
        'domain' => $_POST['domain']
    ];
    $result = $cPanel->execute('uapi', 'DomainInfo', 'single_domain_data', $parameters);
    if (!$result->status == 1) {
        setE("Cannot show domain information : {$result->messages[0]} | {$result->errors[0]}");
        header("location: /index.php");
        die();
    }
    echo $twig->render('domain/info.twig' , ['result' => $result->data]);
    die();
}



// fetching domain list
$result = $cPanel->execute('uapi', 'DomainInfo', 'list_domains');
if (!$result->status == 1) {
    setE("Cannot fetch domains list : {$result->messages[0]} | {$result->errors[0]}");
    header("location: /index.php");
    die();
}
echo $twig->render('domain/show.twig' , ['result' => $result->data]);
clearMessages();
die();