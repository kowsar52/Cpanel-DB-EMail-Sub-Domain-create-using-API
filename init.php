<?php

session_start();

require "cPanel/cPanel.php";
require "vendor/autoload.php";

function clearMessages() {
    $_SESSION['error_message'] = null;
    $_SESSION['success_message'] = null;
}
function setE($message) {
    $_SESSION['error_message'] = $message;
}
function setS($message) {
    $_SESSION['success_message'] = $message;
}


// Twig
$loader = new Twig_Loader_Filesystem(__DIR__ . "/views");
$twig = new Twig_Environment($loader);

if (isset($_SESSION['error_message'])) {
    $twig->addGlobal('error_message', $_SESSION['error_message']);
}
if (isset($_SESSION['success_message'])) {
    $twig->addGlobal('success_message', $_SESSION['success_message']);
}


// cPanel
// How to find host
// Find it through DNS.MYPHPNOTES.TK
$cPanel = new cPanel("USERNAME", "PASSWORD", "HOST");