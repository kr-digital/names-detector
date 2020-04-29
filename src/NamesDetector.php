<?php

declare(strict_types=1);

namespace KRDigital\NamesDetector;

use KRDigital\NamesDetector\Config\ConfigInterface;
use KRDigital\NamesDetector\Engine\EngineFactory;
use KRDigital\NamesDetector\Engine\EngineInterface;
use KRDigital\NamesDetector\Entry\Entry;
use KRDigital\NamesDetector\Entry\Prefix\Prefix;
use KRDigital\NamesDetector\Entry\Prefix\PrefixInterface;
use KRDigital\NamesDetector\Exception\InvalidSearchInputException;

class NamesDetector
{
    /**
     * @var EngineInterface
     */
    protected $engine;

    public function __construct(ConfigInterface $config = null, EngineInterface $engine = null)
    {
        $this->engine = $engine ?? EngineFactory::create($config);
    }

    /**
     * @param bool $strictSearch return null when extract multiple names
     */
    public function extractFirstName(string $input, bool $strictSearch = false): ?Entry
    {
        try {
            $result = $this->engine->extractFirstName($input, $strictSearch);
        } catch (InvalidSearchInputException $exception) {
            return null;
        }

        return $result;
    }

    /**
     * @param bool $strictSearch return null when extract multiple names
     */
    public function extractMiddleName(string $input, bool $strictSearch = false): ?Entry
    {
        try {
            $result = $this->engine->extractMiddleName($input, $strictSearch);
        } catch (InvalidSearchInputException $exception) {
            return null;
        }

        return $result;
    }

    public function createTitle(string $input, PrefixInterface $prefix = null, bool $addMiddleName = true): ?string
    {
        if (null === $prefix) {
            $prefix = new Prefix();
        }

        $firstName = $this->extractFirstName($input, true);

        if (null === $firstName) {
            return null;
        }

        if ($addMiddleName) {
            $middleName = $this->extractMiddleName($input, true);

            if (null === $middleName || !$firstName->getGender()->equals($middleName->getGender())) {
                return null;
            }

            return \sprintf('%s %s %s', $prefix->getPrefixByGender($firstName->getGender()), $firstName->getValue(), $middleName->getValue());
        }

        return \sprintf('%s %s', $prefix->getPrefixByGender($firstName->getGender()), $firstName->getValue());
    }
}
