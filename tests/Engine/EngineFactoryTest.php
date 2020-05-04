<?php

declare(strict_types=1);

namespace KRDigital\NamesDetector\Tests\Engine;

use KRDigital\NamesDetector\Engine\Engine;
use KRDigital\NamesDetector\Engine\EngineFactory;
use PHPUnit\Framework\TestCase;

/**
 * @covers \KRDigital\NamesDetector\Engine\EngineFactory
 */
class EngineFactoryTest extends TestCase
{
    public function testCreate(): void
    {
        self::assertInstanceOf(Engine::class, EngineFactory::create());
    }
}
