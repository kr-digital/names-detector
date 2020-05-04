<?php

declare(strict_types=1);

namespace KRDigital\NamesDetector\Config;

use KRDigital\NamesDetector\Dictionary\DictionaryInterface;

interface ConfigInterface
{
    public function getDictionary(): DictionaryInterface;
}
