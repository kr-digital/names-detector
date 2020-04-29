<?php

declare(strict_types=1);

namespace KRDigital\NamesDetector\Entry;

use KRDigital\NamesDetector\Exception\InvalidTypeException;

class Type
{
    public const TYPE_FIRST_NAME = 'first_name';

    public const TYPE_MIDDLE_NAME = 'middle_name';

    private const ALLOWED_TYPES = [
        self::TYPE_FIRST_NAME,
        self::TYPE_MIDDLE_NAME,
    ];

    /**
     * @var string
     */
    protected $value;

    public function __construct(string $value)
    {
        if (!\in_array($value, self::ALLOWED_TYPES, true)) {
            throw new InvalidTypeException(\sprintf('Type %s is not allowed', $value));
        }

        $this->value = $value;
    }

    public function __toString(): string
    {
        return $this->value;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
