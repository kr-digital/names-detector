<?php

declare(strict_types=1);

namespace KRDigital\NamesDetector\Tests\Engine;

use KRDigital\NamesDetector\Config\Config;
use KRDigital\NamesDetector\Engine\Engine;
use KRDigital\NamesDetector\Entry\Gender;
use KRDigital\NamesDetector\Exception\InvalidSearchInputException;
use PHPUnit\Framework\TestCase;

/**
 * @covers \KRDigital\NamesDetector\Engine\Engine
 */
class EngineTest extends TestCase
{
    /**
     * @dataProvider provideDataForTestExtractFirstName
     */
    public function testExtractFirstName(string $firstName): void
    {
        $engine = new Engine(new Config(null, [
            'first_names' => [
                [
                    $firstName,
                    Gender::GENDER_MALE,
                ],
            ],
            'middle_names' => [],
        ]));

        $entry = $engine->extractFirstName(\sprintf('%s Foo Bar', $firstName));
        self::assertNotNull($entry);
        self::assertEquals($firstName, $entry->getValue());
    }

    public function provideDataForTestExtractFirstName(): array
    {
        return [
            ['Иван'],
            ['Петр'],
            ['Андрей'],
            ['Александр'],
        ];
    }

    /**
     * @dataProvider provideDataForTestExtractMiddleName
     */
    public function testExtractMiddleName(string $middleName): void
    {
        $engine = new Engine(new Config(null, [
            'first_names' => [],
            'middle_names' => [
                [
                    $middleName,
                    Gender::GENDER_MALE,
                ],
            ],
        ]));

        $entry = $engine->extractMiddleName(\sprintf('%s Foo Bar', $middleName));
        self::assertNotNull($entry);
        self::assertEquals($middleName, $entry->getValue());
    }

    public function provideDataForTestExtractMiddleName(): array
    {
        return [
            ['Иванович'],
            ['Петрович'],
            ['Андреевич'],
            ['Александрович'],
        ];
    }

    public function testIncorrectStrictSearch(): void
    {
        $firstName = 'Foo';
        $input = \sprintf('%s %s Bar', $firstName, $firstName);

        $engine = new Engine(new Config(null, [
            'first_names' => [
                [
                    $firstName,
                    Gender::GENDER_MALE,
                ],
            ],
            'middle_names' => [],
        ]));

        $this->expectException(InvalidSearchInputException::class);
        $this->expectExceptionMessage(\sprintf('2 values detected in input %s', $input));

        $engine->extractFirstName($input, true);
    }
}
