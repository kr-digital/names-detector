<?php

declare(strict_types=1);

namespace KRDigital\NamesDetector\Tests;

use KRDigital\NamesDetector\Dictionary\Dictionary;
use KRDigital\NamesDetector\Entry\Entry;
use KRDigital\NamesDetector\Entry\Gender;
use KRDigital\NamesDetector\Entry\Type;
use KRDigital\NamesDetector\Exception\InvalidDictionaryInputDataException;
use PHPUnit\Framework\TestCase;

/**
 * @covers \KRDigital\NamesDetector\Dictionary\Dictionary
 */
class DictionaryTest extends TestCase
{
    public function testFindFirstName(): void
    {
        $dictionaryData = [
            'first_names' => [],
            'middle_names' => [],
        ];

        $entryData1 = [
            'type' => Type::TYPE_FIRST_NAME,
            'gender' => Gender::GENDER_MALE,
            'value' => 'Иннокентий',
        ];

        $entryData2 = [
            'type' => Type::TYPE_FIRST_NAME,
            'gender' => Gender::GENDER_MALE,
            'value' => 'Петр',
        ];

        $dictionaryData['first_names'] = [
            [
                $entryData1['value'],
                $entryData1['gender'],
            ],
            [
                $entryData2['value'],
                $entryData2['gender'],
            ],
        ];

        $dictionary = Dictionary::fromArray($dictionaryData);

        $entry1 = Entry::fromArray($entryData1);
        $entry2 = Entry::fromArray($entryData2);

        self::assertEquals($entry1, $dictionary->findFirstName($entryData1['value']));
        self::assertEquals($entry2, $dictionary->findFirstName($entryData2['value']));
        self::assertNotEquals($entry1, $dictionary->findFirstName($entryData2['value']));
    }

    public function testFindMiddleName(): void
    {
        $dictionaryData = [
            'first_names' => [],
            'middle_names' => [],
        ];

        $entryData1 = [
            'type' => Type::TYPE_MIDDLE_NAME,
            'gender' => Gender::GENDER_MALE,
            'value' => 'Иннокентиевич',
        ];

        $entryData2 = [
            'type' => Type::TYPE_MIDDLE_NAME,
            'gender' => Gender::GENDER_MALE,
            'value' => 'Петрович',
        ];

        $dictionaryData['middle_names'] = [
            [
                $entryData1['value'],
                $entryData1['gender'],
            ],
            [
                $entryData2['value'],
                $entryData2['gender'],
            ],
        ];

        $dictionary = Dictionary::fromArray($dictionaryData);

        $entry1 = Entry::fromArray($entryData1);
        $entry2 = Entry::fromArray($entryData2);

        self::assertEquals($entry1, $dictionary->findMiddleName($entryData1['value']));
        self::assertEquals($entry2, $dictionary->findMiddleName($entryData2['value']));
        self::assertNotEquals($entry1, $dictionary->findMiddleName($entryData2['value']));
    }

    public function testIncorrectInstance(): void
    {
        $this->expectException(InvalidDictionaryInputDataException::class);
        $this->expectExceptionMessage('Input dictionary keys missing: "middle_names"');

        Dictionary::fromArray(['first_names' => []]);
    }

    public function testFindNonExistentFirstName(): void
    {
        $dictionary = Dictionary::fromArray(['first_names' => [], 'middle_names' => []]);

        self::assertNull($dictionary->findFirstName('Foo'));
    }

    public function testFindNonExistentMiddleName(): void
    {
        $dictionary = Dictionary::fromArray(['first_names' => [], 'middle_names' => []]);

        self::assertNull($dictionary->findMiddleName('Foo'));
    }
}
