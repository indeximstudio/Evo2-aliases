<?php

namespace Indeximstudio\Aliases\Exceptions;

use Throwable;

class EmptyTemplateListException extends \Exception
{
    public function __construct($message = 'Empty template list!', $code = 448404, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
