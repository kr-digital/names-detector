<?php

declare(strict_types=1);

namespace KRDigital\NamesDetector\Tests\Entry;

use KRDigital\NamesDetector\Entry\Type;
use PHPUnit\Framework\TestCase;

/**
 * @covers \KRDigital\NamesDetector\Entry\Type
 */
class TypeTest extends TestCase
{
    public function testToString(): void
    {
        $typeValue = Type::TYPE_FIRST_NAME;

        $type = new Type($typeValue);

        self::assertEquals($typeValue, (string) $type);
    }

    public function testGetValue(): void
    {
        $typeValue = Type::TYPE_FIRST_NAME;

        $type = new Type($typeValue);

        self::assertEquals($typeValue, $type->getValue());
    }
}
