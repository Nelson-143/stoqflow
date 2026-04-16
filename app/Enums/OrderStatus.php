<?php

namespace app\Enums;

enum OrderStatus: int
{
    case PENDING = 0;
    case COMPLETED = 1;
    case CANCELLED = 2;

    // If you have string methods, you might have something like:
    public function label(): string
    {
        return match($this) {
            self::PENDING => 'pending',
            self::COMPLETED => 'completed',
            self::CANCELLED => 'cancelled',
        };
    }
}
