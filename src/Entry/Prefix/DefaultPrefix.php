<?php

declare(strict_types=1);

namespace KRDigital\NamesDetector\Entry\Prefix;

use KRDigital\NamesDetector\Entry\Gender;

class DefaultPrefix implements PrefixInterface
{
    public function getMalePrefix(): string
    {
        return 'Уважаемый';
    }

    public function getFemalePrefix(): string
    {
        return 'Уважаемая';
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
