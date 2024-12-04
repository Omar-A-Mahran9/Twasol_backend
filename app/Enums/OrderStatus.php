<?php

namespace App\Enums;

enum OrderStatus: int
{
    case OrderPlaced = 1;
    case PaymentConfirmed = 2;
    case Processing = 3;
    case Shipped = 4;
    case Delivered = 5;
    case Rejected = 6;
    case Canceled = 7;
    case Refund = 8;

    public static function values(): array
    {
        return array_column(self::cases(), 'name', 'value');
    }
    public static function fromString(string $status): self
    {
        return match (strtolower(str_replace('_', ' ', $status))) {
            'orderplaced', 'order placed' => self::OrderPlaced,
            'paymentconfirmed', 'payment confirmed' => self::PaymentConfirmed,
            'processing' => self::Processing,
            'shipped' => self::Shipped,
            'delivered' => self::Delivered,
            'rejected' => self::Rejected,
            'canceled' => self::Canceled,
            'refund' => self::Refund,
            default => throw new \InvalidArgumentException("Invalid status: {$status}"),
        };
    }

}
