<?php

namespace App\Backend;

class LogAnalysis
{
    private const NUMBEROFLINES = 10;

    public function readLargeFile($file)
    {
        $handle = fopen($file, "r");
        $chunk_size = 300;
        $iterations = 0;
        $chunk = [];

        if ($handle) {
            while (!feof($handle)) {
                $iterations++;
                $chunk[$iterations]  = fgets($handle, $chunk_size);
            }
            fclose($handle);
        }
        return $chunk;
    }

    public function  getFirstLines($file)
    {
        $fileOutput = $this->readLargeFile($file);
        if ($fileOutput) {
            $lines = [];
            for ($i = 1; $i <= self::NUMBEROFLINES; $i++) {
                $lines[$i] = $fileOutput[$i];
            }
        }
        return json_encode($lines);
    }
    public function getLastlines($file)
    {
        $fileOutput = $this->readLargeFile($file);
        if ($fileOutput) {
            $lines = [];
            for ($i = count($fileOutput) - self::NUMBEROFLINES; $i <= count($fileOutput) - 1; $i++) {
                $lines[$i] = $fileOutput[$i];
            }
        }

        return json_encode($lines);
    }
    public function  getPreviousLines($file, $currentLine)
    {
        $fileOutput = $this->readLargeFile($file);
        //case we are in the begging of the file
        if ($currentLine + 1 >= self::NUMBEROFLINES) return $this->getFirstLines($file);
        // return json_encode($currentLine);
        if ($fileOutput) {
            $lines = [];
            for ($i = $currentLine + 1 - self::NUMBEROFLINES * 2; $i <= $currentLine - self::NUMBEROFLINES; $i++) {
                $lines[$i] = $fileOutput[$i];
            }
        }

        return json_encode($lines);
    }
    public function  getNextLines($file, $currentLine)
    {
        $fileOutput = $this->readLargeFile($file);
        //case we are in the end of the file 
        if ($currentLine + 1 >= count($fileOutput)) return $this->getLastlines($file);

        if ($fileOutput) {
            $lines = [];
            for ($i = $currentLine + 1; $i <= $currentLine + self::NUMBEROFLINES; $i++) {
                $lines[$i] = $fileOutput[$i];
            }
        }
        return json_encode($lines);
    }
}
