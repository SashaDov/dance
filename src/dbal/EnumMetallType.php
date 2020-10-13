<?php

namespace App\dbal;

class EnumMetallType extends EnumType
{
    protected $name = 'metallenum';
    protected $values = [
        'Gold', 'Silver', 'Platinum',
    ];

    const GOLD = 1;
    const SILVER = 2;
    const PLATINUM = 3;

    public static $static_name = 'metallenum';

    public static $static_values = [
        self::GOLD => 'Gold',
        self::SILVER => 'Silver',
        self::PLATINUM => 'Platinum',
    ];

    public function getValue(int $const)
    {
        return self::$static_values[$const];
    }
}