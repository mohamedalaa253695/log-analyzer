<?php


use PHPUnit\Framework\TestCase;

use App\Backend\LogAnalysis as Log;


class LogAnalysisTest extends TestCase
{
    public function test_get_first_lines()
    {
        $log = new Log();
        $firstLines = json_decode($log->getFirstLines('C:\xampp-7.3\htdocs\homework-challenge-logging\tests\stubs\log.txt'), true);
        $this->assertArrayHasKey(1, $firstLines);
    }
    public function test_get_last_lines()
    {
        $log = new Log();
        $lastLines = json_decode($log->getLastLines('C:\xampp-7.3\htdocs\homework-challenge-logging\tests\stubs\log.txt'), true);
        $this->assertArrayHasKey(32, $lastLines);
    }
    public function test_get_previous_lines()
    {

        $log = new Log();
        $lastLines = json_decode($log->getPreviousLines('C:\xampp-7.3\htdocs\homework-challenge-logging\tests\stubs\log.txt', 20), true);
        $this->assertArrayHasKey(10, $lastLines);
    }
    public function test_get_next_lines()
    {
        $log = new Log();
        $lastLines = json_decode($log->getNextLines('C:\xampp-7.3\htdocs\homework-challenge-logging\tests\stubs\log.txt', 20), true);
        $this->assertArrayHasKey(30, $lastLines);
    }
}
