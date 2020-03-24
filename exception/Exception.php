<?php

namespace Indeximstudio\Aliases\exception;

use Throwable;

class Exception extends \Exception
{
    public function __construct($message = "'aliases' snippet internal error!", $code = 500, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
