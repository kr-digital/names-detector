<?php

declare(strict_types=1);

namespace KRDigital\NamesDetector\Tests\Util;

use KRDigital\NamesDetector\Util\StringUtil;
use PHPUnit\Framework\TestCase;

/**
 * @covers \KRDigital\NamesDetector\Util\StringUtil
 */
class StringUtilTest extends TestCase
{
    /**
     * @dataProvider provideDataForTestCapitalize
     */
    public function testCapitalize(string $input, string $expected): void
    {
        self::assertEquals($expected, StringUtil::capitalize($input));
    }

    public function provideDataForTestCapitalize(): array
    {
        return [
            [
                'иван',
                'Иван',
            ],
            [
                'пЕтРов пЁтр пЕтрович',
                'Петров Пётр Петрович',
            ],
            [
                'foo bar',
                'Foo Bar',
            ],
            [
                '123',
                '123',
            ],
            [
                '',
                '',
            ],
        ];
    }
}
