<?php

namespace App\Traits;

trait EnumValues
{
    public static function values(): array
    {
        return array_map(fn (self $enum): string => $enum->value, self::cases());
    }

    public static function labels(): array
    {
        $output = [];

        foreach (self::cases() as $enum) {
            $output[$enum->value] = ucfirst($enum->value);
        }

        return $output;
    }
}
