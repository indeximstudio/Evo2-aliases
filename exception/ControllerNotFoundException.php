<?php

namespace Indeximstudio\Aliases\exception;

use Throwable;

class ControllerNotFoundException extends Exception
{
    public function __construct($message = "Controller does not exist!", $code = 449404, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
