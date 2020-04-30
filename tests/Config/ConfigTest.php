<?php

declare(strict_types=1);

namespace KRDigital\NamesDetector\Tests\Config;

use KRDigital\NamesDetector\Config\Config;
use KRDigital\NamesDetector\Config\Dictionary;
use KRDigital\NamesDetector\Exception\InvalidDictionarySourceException;
use PHPUnit\Framework\TestCase;

/**
 * @covers \KRDigital\NamesDetector\Config\Config
 */
class ConfigTest extends TestCase
{
    public function testCorrectPhpDictionaryPath(): void
    {
        $dictionaryPath = __DIR__.'/../data/dictionary.php';
        $config = new Config($dictionaryPath);

        $dictionaryData = include $dictionaryPath;
        $dictionary = Dictionary::fromArray($dictionaryData);

        self::assertNotEmpty($config->getDictionary());
        self::assertEquals($config->getDictionary(), $dictionary);
    }

    public function testIncorrectDictionaryPath(): void
    {
        $this->expectException(InvalidDictionarySourceException::class);

        new Config('/foo/bar.txt');
    }

    public function testIncorrectDictionaryExtension(): void
    {
        $this->expectException(InvalidDictionarySourceException::class);
        $this->expectExceptionMessageRegExp('~Extension foo is not valid~');

        new Config(__DIR__.'/../data/dictionary.foo');
    }

    public function testCorrectJsonDictionaryPath(): void
    {
        $dictionaryPath = __DIR__.'/../data/dictionary.json';
        $config = new Config($dictionaryPath);

        $dictionaryData = \json_decode(\file_get_contents($dictionaryPath), true);
        $dictionary = Dictionary::fromArray($dictionaryData);

        self::assertNotEmpty($config->getDictionary());
        self::assertEquals($config->getDictionary(), $dictionary);
    }
}
