<?php

declare(strict_types=1);

namespace KRDigital\NamesDetector\Entry\Prefix;

use KRDigital\NamesDetector\Entry\Gender;

interface PrefixInterface
{
    public function getMalePrefix(): string;

    public function getFemalePrefix(): string;

    public function getPrefixByGender(Gender $gender): string;
}
