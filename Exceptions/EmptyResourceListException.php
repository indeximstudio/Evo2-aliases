<?php

namespace Indeximstudio\Aliases\Exceptions;

use Throwable;

class EmptyResourceListException extends \Exception
{
    public function __construct($message = 'Empty resource list!', $code = 449404, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
