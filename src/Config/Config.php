<?php

declare(strict_types=1);

namespace KRDigital\NamesDetector\Config;

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
     * @var DictionaryInterface
     */
    protected $dictionary;

    public function __construct(string $dictionaryPath, array $dictionary = [])
    {
        if (empty($dictionary) && !\file_exists($dictionaryPath)) {
            throw new InvalidDictionarySourceException(\sprintf('Path %s is invalid', $dictionaryPath));
        }

        $this->dictionary = !empty($dictionary) ? $dictionary : $this->createDictionary($dictionaryPath);
    }

    public function getDictionary(): DictionaryInterface
    {
        return $this->dictionary;
    }

    protected function createDictionary(string $dictionaryPath): DictionaryInterface
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
