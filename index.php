<?php

require "vendor/autoload.php";

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

ob_start();


if (!isset($_SESSION['userId'])) {
    session_start();

    // $_SESSION['userId'] = null;

    $URLArr = explode("/", $_SERVER['REQUEST_URI']);
    $currentPage = $URLArr[count($URLArr) - 1];
    if (empty($_SESSION['userId']) and ($currentPage == 'index.php' or $currentPage == '')) {
        header("Location:" . $_ENV['APP_URL'] . "login.php");
        // header("Location:" . $_ENV['APP_URL'] . "login.php");
        die();
    }
    if (isset($_SESSION['userId']) and ($currentPage == 'index.php' or $currentPage == '')) {
        // unset($_SESSION['userId']);
        header("Location:" . $_ENV['APP_URL'] . "logAnalysis.php");
        die();
    }
}
