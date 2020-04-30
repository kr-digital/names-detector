<?php

declare(strict_types=1);

namespace KRDigital\NamesDetector\Tests;

use KRDigital\NamesDetector\NamesDetector;
use PHPUnit\Framework\TestCase;

/**
 * @covers \KRDigital\NamesDetector\NamesDetector
 */
class NamesDetectorTest extends TestCase
{
    /**
     * @dataProvider provideDataForTestSuccessfulCreateMaleTitle
     */
    public function testSuccessfulCreateMaleTitle(string $input): void
    {
        $namesDetector = new NamesDetector();

        [$lastName, $firstName, $middleName] = \explode(' ', $input);
        $output = \sprintf('Уважаемый %s %s', $firstName, $middleName);

        self::assertEquals($output, $namesDetector->createTitle($input));
    }

    public function provideDataForTestSuccessfulCreateMaleTitle(): array
    {
        return [
            ['Юдин Ефрем Андреевич'],
            ['Ларионов Станислав Платонович'],
            ['Беспалов Руслан Михайлович'],
            ['Потапов Андрей Максимович'],
            ['Шилов Антон Игоревич'],
            ['Денисов Валерий Геннадиевич'],
            ['Кулагин Сергей Леонидович'],
            ['Владимиров Ефим Михайлович'],
            ['Фомичёв Леонтий Дамирович'],
            ['Власов Роман Давидович'],
            ['Агафонов Лаврентий Егорович'],
            ['Лыткин Платон Робертович'],
            ['Титов Филипп Ярославович'],
            ['Кулаков Мартин Григорьевич'],
            ['Давыдов Владлен Георгиевич'],
            ['Мышкин Бенедикт Лаврентьевич'],
            ['Карпов Мстислав Дмитриевич'],
            ['Гущин Олег Евгеньевич'],
            ['Беспалов Валерий Макарович'],
            ['Харитонов Натан Викторович'],
            ['Макаров Аким Валерьевич'],
            ['Комиссаров Велор Глебович'],
            ['Морозов Рубен Максимович'],
            ['Федосеев Никифор Дамирович'],
            ['Самойлов Эрнест Наумович'],
            ['Меркушев Ярослав Георгиевич'],
            ['Миронов Витольд Владиславович'],
            ['Воронцов Борис Игоревич'],
            ['Шестаков Дональд Григорьевич'],
            ['Ситников Зиновий Станиславович'],
            ['Кириллов Май Тимофеевич'],
            ['Евсеев Натан Алексеевич'],
            ['Филатов Тихон Филиппович'],
            ['Ларионов Георгий Петрович'],
            ['Рыбаков Эрнест Матвеевич'],
            ['Миронов Алексей Львович'],
            ['Куликов Прохор Денисович'],
            ['Наумов Юлиан Глебович'],
        ];
    }

    /**
     * @dataProvider provideDataForTestSuccessfulCreateFemaleTitle
     */
    public function testSuccessfulCreateFemaleTitle(string $input): void
    {
        $namesDetector = new NamesDetector();

        [$lastName, $firstName, $middleName] = \explode(' ', $input);
        $output = \sprintf('Уважаемая %s %s', $firstName, $middleName);

        self::assertEquals($output, $namesDetector->createTitle($input));
    }

    public function provideDataForTestSuccessfulCreateFemaleTitle(): array
    {
        return [
            ['Федосеева Николь Степановна'],
            ['Абрамова Гражина Филипповна'],
            ['Хохлова Устинья Рудольфовна'],
            ['Соколова Изабелла Яковлевна'],
            ['Колесникова Ивона Витальевна'],
            ['Осипова Калерия Давидовна'],
            ['Доронина Капитолина Тимуровна'],
            ['Федотова Марта Семеновна'],
            ['Евдокимова Евдокия Ивановна'],
            ['Фролова Яна Евгеньевна'],
            ['Белякова Ольга Валерьевна'],
            ['Романова Жасмин Алексеевна'],
            ['Куликова Эдда Романовна'],
            ['Соболева Виктория Геннадьевна'],
            ['Попова Александра Александровна'],
            ['Нестерова Милана Тарасовна'],
            ['Гущина Вера Сергеевна'],
            ['Антонова Лилия Еремеевна'],
            ['Мартынова Ева Яковлевна'],
            ['Павлова Оксана Артемовна'],
            ['Гурьева Глафира Викторовна'],
            ['Лазарева Ванесса Игнатьевна'],
            ['Зыкова Есения Ивановна'],
            ['Герасимова Лира Игоревна'],
        ];
    }

    /**
     * @dataProvider provideDataForTestUnsuccessfulCreateTitle
     */
    public function testUnsuccessfulCreateTitle(string $input): void
    {
        $namesDetector = new NamesDetector();

        self::assertNull($namesDetector->createTitle($input));
    }

    public function provideDataForTestUnsuccessfulCreateTitle(): array
    {
        return [
            ['Тестов Тест Тестович'],
            ['Сидорова Надежда Александрович'],
        ];
    }
}
