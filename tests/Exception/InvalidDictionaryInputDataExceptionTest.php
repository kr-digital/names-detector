<?php

declare(strict_types=1);

namespace KRDigital\NamesDetector\Tests\Exception;

use KRDigital\NamesDetector\Exception\InvalidDictionaryInputDataException;
use PHPUnit\Framework\TestCase;

/**
 * @covers \KRDigital\NamesDetector\Exception\AbstractInputDataException
 */
class InvalidDictionaryInputDataExceptionTest extends TestCase
{
    public function testExceptionMessage(): void
    {
        $keys = ['foo', 'bar'];
        $message = 'Test message';

        $exception = new InvalidDictionaryInputDataException($message, $keys);

        self::assertEquals(\sprintf('%s: "%s"', $message, \implode(', ', $keys)), $exception->getMessage());
    }
}
