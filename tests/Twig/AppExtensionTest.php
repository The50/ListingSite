<?php

namespace App\Tests\Twig;

use DateTime;
use PHPUnit\Framework\TestCase;
use App\Twig\AppExtension;

class AppExtensionTest extends TestCase
{
    /**
     * @dataProvider provideDates
     * @param DateTime $dateFrom
     * @param DateTime $dateTill
     * @param bool $expected
     */
    public function testCheckIfPromo(DateTime $dateFrom, DateTime $dateTill, bool $expected)
    {
        $appExtension = new AppExtension();
        $this->assertEquals($expected, $appExtension->checkIfPromo($dateFrom, $dateTill));
    }

    public function provideDates()
    {
        return [
            [new DateTime('2000-06-25 00:00:00'), new DateTime('2050-06-25 00:00:00'), true],
            [new DateTime('2000-06-25 00:00:00'), new DateTime('2018-06-25 00:00:00'), false],
            [new DateTime('1993-05-25 00:00:00'), new DateTime('2050-06-25 00:00:00'), true]
        ];
    }
}
