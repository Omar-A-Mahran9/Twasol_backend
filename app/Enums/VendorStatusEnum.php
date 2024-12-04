<?php
namespace App\Enums;

enum VendorStatusEnum: int
{
    case Pending = 0;
    case Approved = 1;
    case Rejected = 2;
    case Blocking = 3;

    public static function values(): array
    {
        return array_column(self::cases(), 'name', 'value');
    }
}
