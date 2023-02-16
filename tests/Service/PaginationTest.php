<?php

namespace App\Tests\Controller;

use App\Service\Pagination;
use PHPUnit\Framework\TestCase;

class PaginationTest extends TestCase
{
    public function testOneElement()
    {
        $pagination = new Pagination();

        $actual = $pagination->paginate(1, 1);

        $expected = [
            'current' => 1,
            'prev'    => 0,
            'next'    => 0,
            'items'   => [1 => 1],
        ];

        $this->assertEquals($expected, $actual);
    }

    public function testSecondPage()
    {
        $pagination = new Pagination();

        $actual = $pagination->paginate(2, 10);

        $expected = [
            'current' => 2,
            'prev'    => 1,
            'next'    => 3,
            'items'   => [
                1 => 1,
                2 => 2,
                3 => 3,
                4 => 4,
                5 => '…',
                10 => 10,
            ],
        ];

        $this->assertEquals($expected, $actual);
    }

    public function testFirstElements()
    {
        $pagination = new Pagination();

        $actual = $pagination->paginate(1, 10);

        $expected = [
            'current' => 1,
            'prev'    => 0,
            'next'    => 2,
            'items'   => [
                1 => 1,
                2 => 2,
                3 => 3,
                4 => '…',
                10 => 10,
            ],
        ];

        $this->assertEquals($expected, $actual);
    }

    public function testLastElements()
    {
        $pagination = new Pagination();

        $actual = $pagination->paginate(10, 10);

        $expected = [
            'current' => 10,
            'prev'    => 9,
            'next'    => 0,
            'items'   => [
                1 => 1,
                7 => '…',
                8 => 8,
                9 => 9,
                10 => 10,
            ],
        ];

        $this->assertEquals($expected, $actual);
    }
}
