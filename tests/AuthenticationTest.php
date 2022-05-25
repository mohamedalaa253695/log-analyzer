<?php

// namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Backend\Authentication as Auth;
use SebastianBergmann\CodeCoverage\Driver\Xdebug;

ob_start();


class AuthenticationTest extends TestCase
{
    public function test_user_can_login()
    {
        $auth = new Auth();

        $_ENV['PASSWORD'] = 'admin';
        $_ENV['USERNAME'] = 'admin';
        $_ENV['APP_URL'] = 'http://localhost/homework-challenge-logging/src/frontend/';

        $auth->login('admin', 'admin');


        $this->assertEquals('adminadmin', $_SESSION['userId']);

        $this->assertContains('Location:' . $_ENV['APP_URL'] . 'logAnalysis.php', xdebug_get_headers());
    }
}
