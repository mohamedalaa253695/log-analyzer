<?php

namespace App\Backend;

class Authentication
{


    public function login($userName = NULL, $password = NULL)
    {

        if (empty($userName)) return ['message' => "Username field required"];
        if (empty($password)) return  ['message' => "Password field required"];

        if ($userName == $_ENV['USERNAME'] and $password == $_ENV['PASSWORD']) {
            $_SESSION['userId'] = $userName . $password;
            header("Location:" . $_ENV['APP_URL'] . "logAnalysis.php");
            // die();
        }
    }
}
