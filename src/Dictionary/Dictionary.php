<?php

declare(strict_types=1);

namespace KRDigital\NamesDetector\Dictionary;

use KRDigital\NamesDetector\Entry\Entry;
use KRDigital\NamesDetector\Entry\Type;
use KRDigital\NamesDetector\Exception\InvalidDictionaryInputDataException;
use KRDigital\NamesDetector\Util\StringUtil;

class Dictionary implements DictionaryInterface
{
    protected $firstNames;

    protected $middleNames;

    protected function __construct(array $firstNames, array $middleNames)
    {
        $this->firstNames = $firstNames;
        $this->middleNames = $middleNames;
    }

    public static function fromArray(array $data): self
    {
        if ($diff = \array_diff(['first_names', 'middle_names'], \array_keys($data))) {
            throw new InvalidDictionaryInputDataException('Input dictionary keys missing', $diff);
        }

        return new static($data['first_names'], $data['middle_names']);
    }

    public function findFirstName(string $name): ?Entry
    {
        $key = self::getKey($name, $this->firstNames);

        $result = $this->firstNames[$key] ?? null;

        if (null !== $result) {
            return Entry::fromArray(['type' => Type::TYPE_FIRST_NAME, 'gender' => $result[1] ?? null, 'value' => $result[0] ?? null]);
        }

        return null;
    }

    public function findMiddleName(string $name): ?Entry
    {
        $key = self::getKey($name, $this->middleNames);

        $result = $this->middleNames[$key] ?? null;

        if (null !== $result) {
            return Entry::fromArray(['type' => Type::TYPE_MIDDLE_NAME, 'gender' => $result[1] ?? null, 'value' => $result[0] ?? null]);
        }

        return null;
    }

    /**
     * @return int|string|null
     */
    protected static function getKey(string $name, array $data)
    {
        $key = \array_search(StringUtil::capitalize($name), \array_column($data, 0), true);

        if (false === $key) {
            return null;
        }

        return $key;
    }
}
