<?php

declare(strict_types=1);

namespace KRDigital\NamesDetector\Tests\Entry;

use KRDigital\NamesDetector\Entry\Entry;
use KRDigital\NamesDetector\Entry\Gender;
use KRDigital\NamesDetector\Entry\Type;
use KRDigital\NamesDetector\Exception\InvalidEntryInputDataException;
use PHPUnit\Framework\TestCase;

/**
 * @covers \KRDigital\NamesDetector\Entry\Entry
 */
class EntryTest extends TestCase
{
    public function testGetGender(): void
    {
        $genderValue = Gender::GENDER_MALE;

        $data = [
            'type' => Type::TYPE_FIRST_NAME,
            'gender' => $genderValue,
            'value' => 'Foo',
        ];

        self::assertEquals($genderValue, Entry::fromArray($data)->getGender()->getValue());
    }

    public function testGetValue(): void
    {
        $value = 'Foo';

        $data = [
            'type' => Type::TYPE_FIRST_NAME,
            'gender' => Gender::GENDER_MALE,
            'value' => $value,
        ];

        self::assertEquals($value, Entry::fromArray($data)->getValue());
    }

    public function testGetType(): void
    {
        $typeValue = Type::TYPE_FIRST_NAME;

        $data = [
            'type' => $typeValue,
            'gender' => Gender::GENDER_MALE,
            'value' => 'Foo',
        ];

        self::assertEquals($typeValue, Entry::fromArray($data)->getType()->getValue());
    }

    public function testIncorrectInstance(): void
    {
        $this->expectException(InvalidEntryInputDataException::class);
        $this->expectExceptionMessage('Input entry keys missing: "gender, value"');

        Entry::fromArray(['type' => Type::TYPE_FIRST_NAME]);
    }
}
