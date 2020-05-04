<?php

declare(strict_types=1);

namespace KRDigital\NamesDetector\Tests\Entry;

use KRDigital\NamesDetector\Entry\Gender;
use PHPUnit\Framework\TestCase;

/**
 * @covers \KRDigital\NamesDetector\Entry\Gender
 */
class GenderTest extends TestCase
{
    public function testToString(): void
    {
        $genderValue = Gender::GENDER_MALE;

        $gender = new Gender($genderValue);

        self::assertEquals($genderValue, (string) $gender);
    }

    public function testGetValue(): void
    {
        $genderValue = Gender::GENDER_MALE;

        $gender = new Gender($genderValue);

        self::assertEquals($genderValue, $gender->getValue());
    }

    public function testEquals(): void
    {
        $genderMale = new Gender(Gender::GENDER_MALE);
        $genderFemale = new Gender(Gender::GENDER_FEMALE);

        $referenceGender = new Gender(Gender::GENDER_MALE);

        self::assertTrue($genderMale->equals($referenceGender));
        self::assertFalse($genderFemale->equals($referenceGender));
    }
}
