<?php

namespace App\Frontend;

use App\Backend\LogAnalysis as Log;


require "../../index.php";


$_POST = json_decode(file_get_contents("php://input"), true);
header('Content-Type: application/json; charset=utf-8');


$URI = explode("/", $_SERVER['REQUEST_URI']);
$endpoint = $URI[5];
if ($endpoint == 'getFirstLines') {
    $log = new Log();
    print $log->getFirstLines($_POST['file']);
};

if ($endpoint == 'getLastlines') {
    $log = new Log();
    print $log->getLastlines($_POST['file']);
};
if ($endpoint == 'getPreviousLines') {
    $log = new Log();
    print $log->getPreviousLines($_POST['file'], $_POST['currentLine']);
};
if ($endpoint == 'getNextLines') {
    $log = new Log();
    print $log->getNextLines($_POST['file'], $_POST['currentLine']);
};
