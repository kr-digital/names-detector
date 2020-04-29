<?php

declare(strict_types=1);

namespace KRDigital\NamesDetector\Entry;

use KRDigital\NamesDetector\Exception\InvalidEntryInputDataException;

class Entry
{
    /**
     * @var Type
     */
    protected $type;

    /**
     * @var Gender
     */
    protected $gender;

    /**
     * @var string
     */
    protected $value;

    protected function __construct(Type $type, Gender $gender, string $value)
    {
        $this->type = $type;
        $this->gender = $gender;
        $this->value = $value;
    }

    public static function fromArray(array $data): self
    {
        if ($diff = \array_diff(\array_keys($data), ['type', 'gender', 'value'])) {
            throw new InvalidEntryInputDataException('Invalid input keys', $diff);
        }

        return new static(new Type($data['type']), new Gender($data['gender']), $data['value']);
    }

    public function getType(): Type
    {
        return $this->type;
    }

    public function getGender(): Gender
    {
        return $this->gender;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
