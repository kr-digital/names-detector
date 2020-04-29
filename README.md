# Names-detector

Библиотека умеет определять имя, отчество и пол пользовател по json-словарю, а также составлять обращение к нему на основе произвольной строки.

## Быстрый старт
```php
<?php

$namesDetector = new \KRDigital\NamesDetector\NamesDetector();

// $entry->getValue() = 'Иван', $entry->getGender()->getValue() = 'm'
$firstNameEntry = $namesDetector->extractFirstName('Иванов Иван Иванович'); 

// $middleNameEntry->getValue() = 'Иванович', $middleNameEntry->getGender()->getValue() = 'm'
$middleNameEntry = $namesDetector->extractMiddleName('Иванов Иван Иванович'); 

// $title = 'Уважаемая Мария Петровна'
$title = $namesDetector->createTitle('Мария Петровна Смирнова');
```

## Работа с кастомным словарем

Валидный формат словаря в формате JSON:
```json
{
  "first_names": [
    [
      "Андрей",
      "m"
    ],
    [
      "Надежда",
      "f"
    ]
  ],
  "middle_names": [
    [
      "Александрович",
      "m"
    ],
    [
      "Александровна",
      "f"
    ]
  ]
}
```

В формате php:
```php
<?php

return [
  'first_names' => [
      [
          'Андрей',
          'm',
      ],
      [
          'Надежда',
          'f',
      ],
  ],
    'middle_names' => [
        [
            'Александрович',
            'm',
        ],
        [
            'Александровна',
            'f',
        ],
    ],
];
```

Использование своего словаря:
```php
<?php

$customDictionaryPath = '/var/www/app/data/en_dictionary.json';

// поддерживаемые форматы: php, json
$config = new \KRDigital\NamesDetector\Config\Config($customDictionaryPath);

$namesDetector = new \KRDigital\NamesDetector\NamesDetector($config);

...
```

## Кастомные обращения
```php
<?php

$namesDetector = new \KRDigital\NamesDetector\NamesDetector();

$prefix = new \KRDigital\NamesDetector\Entry\Prefix\Prefix('Дорогой', 'Дорогая');

$namesDetector->createTitle('Иванов Иван Иванович', $prefix); // 'Дорогой Иван Иванович'
```