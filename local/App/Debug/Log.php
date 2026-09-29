<?php

namespace Debug;

use Bitrix\Main\Diag\ExceptionHandlerLog;
class Log extends ExceptionHandlerLog
{
    private $filePath;

    /**
     * @param $filePath
     */
    public function __construct($filePath = null)
    {
        $this->filePath = $filePath;

    }

    /**
     * @param array $options
     * @return void
     */
    public function initialize (array $options)
    {
        $this->filePath = $_SERVER["DOCUMENT_ROOT"] . $options['file'];
    }

    /**
     * @param $exception
     * @param $logType
     * @return void
     */
    public function write($exception, $logType= null)
    {
        $message = $exception instanceof \Throwable ? $exception -> getMessage() : $exception;
        $line = date('Y-m-d H:i:s') . ' OTUS ' . $message . PHP_EOL;
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
