<?php

declare(strict_types=1);

namespace KRDigital\NamesDetector\Dictionary;

use KRDigital\NamesDetector\Entry\Entry;

interface DictionaryInterface
{
    public function findFirstName(string $input): ?Entry;

    public function findMiddleName(string $input): ?Entry;
}
