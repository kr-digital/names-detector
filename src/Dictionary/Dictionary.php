<?php

declare(strict_types=1);

namespace KRDigital\NamesDetector\Dictionary;

use KRDigital\NamesDetector\Entry\Entry;
use KRDigital\NamesDetector\Entry\Type;
use KRDigital\NamesDetector\Exception\InvalidDictionaryInputDataException;

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
        if ($diff = \array_diff(\array_keys($data), ['first_names', 'middle_names'])) {
            throw new InvalidDictionaryInputDataException('Invalid input keys', $diff);
        }

        return new static($data['first_names'], $data['middle_names']);
    }

    public function findFirstName(string $name): ?Entry
    {
        $key = \array_search($name, \array_column($this->firstNames, 0), true);

        if (false === $key) {
            return null;
        }

        $result = $this->firstNames[$key] ?? null;

        if (null !== $result) {
            return Entry::fromArray(['type' => Type::TYPE_FIRST_NAME, 'gender' => $result[1] ?? null, 'value' => $result[0] ?? null]);
        }

        return null;
    }

    public function findMiddleName(string $name): ?Entry
    {
        $key = \array_search($name, \array_column($this->middleNames, 0), true);

        if (false === $key) {
            return null;
        }

        $result = $this->middleNames[$key] ?? null;

        if (null !== $result) {
            return Entry::fromArray(['type' => Type::TYPE_MIDDLE_NAME, 'gender' => $result[1] ?? null, 'value' => $result[0] ?? null]);
        }

        return null;
    }
}
