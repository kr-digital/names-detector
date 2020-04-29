<?php

declare(strict_types=1);

namespace KRDigital\NamesDetector\Entry;

use KRDigital\NamesDetector\Exception\InvalidGenderException;

class Gender
{
    public const GENDER_MALE = 'm';

    public const GENDER_FEMALE = 'f';

    private const ALLOWED_GENDERS = [
        self::GENDER_MALE,
        self::GENDER_FEMALE,
    ];

    /**
     * @var string
     */
    protected $value;

    public function __construct(string $value)
    {
        if (!\in_array($value, self::ALLOWED_GENDERS, true)) {
            throw new InvalidGenderException(\sprintf('Gender %s is not allowed', $value));
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

    public function equals(self $referenceGender): bool
    {
        return $this->getValue() === $referenceGender->getValue();
    }
}
