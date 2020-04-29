<?php

declare(strict_types=1);

namespace KRDigital\NamesDetector\Engine;

use KRDigital\NamesDetector\Config\ConfigInterface;
use KRDigital\NamesDetector\Entry\Entry;
use KRDigital\NamesDetector\Entry\Type;
use KRDigital\NamesDetector\Exception\InvalidSearchInputException;

class Engine implements EngineInterface
{
    /**
     * @var ConfigInterface
     */
    protected $config;

    public function __construct(ConfigInterface $config)
    {
        $this->config = $config;
    }

    public function extractFirstName(string $input, bool $strict = false): ?Entry
    {
        return $this->findValueByType($input, Type::TYPE_FIRST_NAME, $strict);
    }

    public function extractMiddleName(string $input, bool $strict = false): ?Entry
    {
        return $this->findValueByType($input, Type::TYPE_MIDDLE_NAME, $strict);
    }

    protected function findValueByType(string $input, string $type, bool $strict): ?Entry
    {
        $entry = null;
        $resultsQuantity = 0;
        foreach (\explode(' ', $input) as $value) {
            switch ($type) {
                case Type::TYPE_FIRST_NAME:
                    $result = $this->config->getDictionary()->findFirstName($value);
                    break;
                case Type::TYPE_MIDDLE_NAME:
                    $result = $this->config->getDictionary()->findMiddleName($value);
                    break;
                default:
                    throw new \LogicException(\sprintf('Invalid type %s', $type));
            }

            if (null !== $result) {
                if (!$strict) {
                    return $result;
                }

                $entry = $result;

                ++$resultsQuantity;
            }
        }

        if ($strict && $resultsQuantity > 1) {
            throw new InvalidSearchInputException(\sprintf('%d values detected in input %s', $resultsQuantity, $input));
        }

        return $entry;
    }
}
