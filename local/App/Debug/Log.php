<?php

namespace Debug;

class Log
{
    private $filePath;

    /**
     * @param $filePath
     */
    public function __construct($filePath)
    {
        $this->filePath = $filePath;
    }

    /**
     * @param $message
     * @return void
     */
    public function write($message)
    {
        $line = date('Y-m-d H:i:s') . 'OTUS' . $message . PHP_EOL;
        file_put_contents($this->filePath, $line, FILE_APPEND);
    }

    /**
     * @return void
     */
    public function clear()
    {
        file_put_contents($this->filePath, '');
    }
}
