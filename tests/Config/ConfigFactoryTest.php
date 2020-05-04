<?php

declare(strict_types=1);

namespace KRDigital\NamesDetector\Tests\Config;

use KRDigital\NamesDetector\Config\Config;
use KRDigital\NamesDetector\Config\ConfigFactory;
use PHPUnit\Framework\TestCase;

/**
 * @covers \KRDigital\NamesDetector\Config\ConfigFactory
 */
class ConfigFactoryTest extends TestCase
{
    public function testCreate(): void
    {
        self::assertInstanceOf(Config::class, ConfigFactory::create());
    }
}
