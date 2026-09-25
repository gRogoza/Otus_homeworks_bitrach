<?php

namespace Debug;

class MyException extends \Exception
{
    /**
     * @param $message
     */
    public function __construct($message)
  {
      parent::__construct('Otus' . $message);
  }
}