<?php
namespace App\Enums;

enum PayingOffStatus:int{
    case Paid = 2;
    case cashOnDelivery = 1;

    public static function values(): array
    {
        return array_column(self::cases(), 'name', 'value');
    }
}
