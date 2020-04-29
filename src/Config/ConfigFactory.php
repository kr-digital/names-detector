<?php

declare(strict_types=1);

namespace KRDigital\NamesDetector\Config;

class ConfigFactory
{
    public static function create(string $dictionaryPath = null): ConfigInterface
    {
        if (null === $dictionaryPath) {
            $dictionaryPath = __DIR__.'../../data/dictionary.json';
        }

        return new Config($dictionaryPath);
    }
}
