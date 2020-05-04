<?php

declare(strict_types=1);

namespace KRDigital\NamesDetector\Tests\Entry\Prefix;

use KRDigital\NamesDetector\Entry\Gender;
use KRDigital\NamesDetector\Entry\Prefix\Prefix;
use PHPUnit\Framework\TestCase;

/**
 * @covers \KRDigital\NamesDetector\Entry\Prefix\Prefix
 */
class PrefixTest extends TestCase
{
    public function testCustomPrefixValue(): void
    {
        $malePrefix = 'foo';
        $femalePrefix = 'bar';

        $prefix = new Prefix($malePrefix, $femalePrefix);

        self::assertEquals($malePrefix, $prefix->getMalePrefix());
        self::assertEquals($femalePrefix, $prefix->getFemalePrefix());
    }

    public function testGetMalePrefix(): void
    {
        $prefix = new Prefix();

        self::assertEquals('Уважаемый', $prefix->getMalePrefix());
    }

    public function testGetFemalePrefix(): void
    {
        $prefix = new Prefix();

        self::assertEquals('Уважаемая', $prefix->getFemalePrefix());
    }

    public function testGetPrefixByGender(): void
    {
        $gender = new Gender(Gender::GENDER_FEMALE);
        $femalePrefix = 'foo';

        $prefix = new Prefix(null, $femalePrefix);

        self::assertEquals($femalePrefix, $prefix->getPrefixByGender($gender));
    }
}
