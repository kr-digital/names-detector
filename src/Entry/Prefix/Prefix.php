<?php

declare(strict_types=1);

namespace KRDigital\NamesDetector\Entry\Prefix;

use KRDigital\NamesDetector\Entry\Gender;

class Prefix implements PrefixInterface
{
    /**
     * @var string
     */
    protected $malePrefix;

    /**
     * @var string
     */
    protected $femalePrefix;

    public function __construct(string $malePrefix = null, string $femalePrefix = null)
    {
        $this->malePrefix = $malePrefix ?? 'Уважаемый';
        $this->femalePrefix = $femalePrefix ?? 'Уважаемая';
    }

    public function getMalePrefix(): string
    {
        return $this->malePrefix;
    }

    public function getFemalePrefix(): string
    {
        return $this->femalePrefix;
    }

    public function getPrefixByGender(Gender $gender): string
    {
        switch ($gender->getValue()) {
            case Gender::GENDER_MALE:
                return $this->getMalePrefix();
            case Gender::GENDER_FEMALE:
                return $this->getFemalePrefix();
            default:
                throw new \LogicException(\sprintf('Invalid type %s', $gender->getValue()));
        }
    }
}
