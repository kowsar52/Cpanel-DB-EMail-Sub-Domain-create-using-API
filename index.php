<?php

require "init.php";

echo $twig->render("index.twig");
clearMessages();
die();