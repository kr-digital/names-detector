<?php

declare(strict_types=1);

namespace KRDigital\NamesDetector\Exception;

abstract class AbstractInputDataException extends \InvalidArgumentException
{
    public function __construct($message = '', array $invalidKeys = [])
    {
        if (!empty($invalidKeys)) {
            $message .= \sprintf(' %s', \implode(', ', $invalidKeys));
        }

        parent::__construct($message);
    }
}
