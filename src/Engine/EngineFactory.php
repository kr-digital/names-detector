<?php

declare(strict_types=1);

namespace KRDigital\NamesDetector\Engine;

use KRDigital\NamesDetector\Config\ConfigFactory;
use KRDigital\NamesDetector\Config\ConfigInterface;

class EngineFactory
{
    public static function create(ConfigInterface $config = null): EngineInterface
    {
        if (null === $config) {
            $config = ConfigFactory::create();
        }

        return new Engine($config);
    }
}
