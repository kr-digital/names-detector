<?php

declare(strict_types=1);

namespace KRDigital\NamesDetector\Config;

use KRDigital\NamesDetector\Dictionary\Dictionary;
use KRDigital\NamesDetector\Dictionary\DictionaryInterface;
use KRDigital\NamesDetector\Exception\InvalidDictionarySourceException;

class Config implements ConfigInterface
{
    private const EXTENSION_JSON = 'json';

    private const EXTENSION_PHP = 'php';

    private const ALLOWED_EXTENSIONS = [
        self::EXTENSION_JSON,
        self::EXTENSION_PHP,
    ];

    /**
     * @var string|null
     */
    protected $dictionaryPath;

    /**
     * @var array|null
     */
    protected $dictionaryData;

    /**
     * @var DictionaryInterface
     */
    protected $dictionary;

    public function __construct(string $dictionaryPath = null, array $dictionaryData = [])
    {
        if (empty($dictionaryData) && null === $dictionaryPath) {
            throw new InvalidDictionarySourceException('No input data is provided');
        }

        if (null !== $dictionaryPath && !\file_exists($dictionaryPath)) {
            throw new InvalidDictionarySourceException(\sprintf('Path %s is invalid', $dictionaryPath));
        }

        $this->dictionaryPath = $dictionaryPath;
        $this->dictionaryData = $dictionaryData;
    }

    public function getDictionary(): DictionaryInterface
    {
        if (null === $this->dictionary) {
            $this->dictionary = $this->initDictionary();
        }

        return $this->dictionary;
    }

    protected function initDictionary(): DictionaryInterface
    {
        if (!empty($this->dictionaryData)) {
            return Dictionary::fromArray($this->dictionaryData);
        }

        return $this->createDictionaryFromFile($this->dictionaryPath);
    }

    protected function createDictionaryFromFile(string $dictionaryPath): DictionaryInterface
    {
        $dictionaryExtension = \pathinfo($dictionaryPath, PATHINFO_EXTENSION);

        switch ($dictionaryExtension) {
            case self::EXTENSION_PHP:
                try {
                    $data = include $dictionaryPath;

                    return Dictionary::fromArray($data);
                } catch (\ParseError $error) {
                    throw new InvalidDictionarySourceException('Dictionary php file is invalid');
                }
            case self::EXTENSION_JSON:
                // JSON_THROW_ON_ERROR polyfill
                if (null === $data = \json_decode(\file_get_contents($dictionaryPath), true)) {
                    throw new InvalidDictionarySourceException('Dictionary json file is invalid');
                }

                return Dictionary::fromArray($data);
            default:
                throw new InvalidDictionarySourceException(\sprintf('Extension %s is not valid, allowed extensions are %s', $dictionaryExtension, \implode(', ', self::ALLOWED_EXTENSIONS)));
        }
    }
}
