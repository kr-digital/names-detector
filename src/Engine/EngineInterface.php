<?php

declare(strict_types=1);

namespace KRDigital\NamesDetector\Engine;

use KRDigital\NamesDetector\Entry\Entry;

interface EngineInterface
{
    public function extractFirstName(string $input, bool $strict): ?Entry;

    public function extractMiddleName(string $input, bool $strict): ?Entry;
}
