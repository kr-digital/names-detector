<?php

declare(strict_types=1);

namespace KRDigital\NamesDetector\Tests;

use KRDigital\NamesDetector\Config\Config;
use KRDigital\NamesDetector\NamesDetector;
use PHPUnit\Framework\TestCase;

class NamesDetectorTest extends TestCase
{
    /**
     * @dataProvider provideDataForTestSuccessfulCreateTitle
     */
    public function testSuccessfulCreateTitle(string $input, string $output): void
    {
        $dictionaryPath = __DIR__.'/data/dictionary.php';

        $namesDetector = new NamesDetector(new Config($dictionaryPath));

        self::assertEquals($output, $namesDetector->createTitle($input));
    }

    public function provideDataForTestSuccessfulCreateTitle(): array
    {
        return [
            [
                'Иванов Андрей Александрович',
                'Уважаемый Андрей Александрович',
            ],
            [
                'Андрей Александрович Смирнов',
                'Уважаемый Андрей Александрович',
            ],
            [
                'Надежда Александровна Петрова',
                'Уважаемая Надежда Александровна',
            ],
            [
                'Петрова Надежда Александровна',
                'Уважаемая Надежда Александровна',
            ],
        ];
    }

    /**
     * @dataProvider provideDataForTestUnsuccessfulCreateTitle
     */
    public function testUnsuccessfulCreateTitle(string $input): void
    {
        $dictionaryPath = __DIR__.'/data/dictionary.php';

        $namesDetector = new NamesDetector(new Config($dictionaryPath));

        self::assertNull($namesDetector->createTitle($input));
    }

    public function provideDataForTestUnsuccessfulCreateTitle(): array
    {
        return [
            [
                'Тестов Тест Тестович',
            ],
            [
                'Сидорова Надежда Александрович',
            ],
        ];
    }
}
