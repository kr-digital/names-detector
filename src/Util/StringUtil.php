<?php

declare(strict_types=1);

namespace KRDigital\NamesDetector\Util;

class StringUtil
{
    public static function capitalize(string $input): string
    {
        $result = [];

        foreach (\explode(' ', $input) as $word) {
            $result[] = \sprintf('%s%s', \mb_strtoupper(\mb_substr($word, 0, 1)), \mb_strtolower(\mb_substr($word, 1, \mb_strlen($word) - 1)));
        }

        return \implode(' ', $result);
    }
}
