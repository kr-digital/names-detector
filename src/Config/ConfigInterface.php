<?php

declare(strict_types=1);

namespace KRDigital\NamesDetector\Config;

interface ConfigInterface
{
    public function getDictionary(): DictionaryInterface;
}
