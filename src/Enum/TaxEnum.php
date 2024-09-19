<?php

namespace App\Enum;

enum TaxEnum: string
{
    case DE = 'DE';
    case IT = 'IT';
    case FR = 'FR';
    case GR = 'GR';

    public static function getFromRegExpCheck(string $value): ?self
    {
        foreach (self::cases() as $case) {
            if (preg_match(self::getRegExp($case), $value)) {
                return $case;
            }
        }

        return null;
    }

    public static function getName(TaxEnum $enum): string
    {
        return match ($enum) {
            self::DE => 'Германия',
            self::IT => 'Италия',
            self::FR => 'Франция',
            self::GR => 'Греция',
        };
    }

    public static function getRegExp(TaxEnum $enum): string
    {
        return match ($enum) {
            self::DE => '/^DE\d{8}$/',
            self::IT => '/^IT\d{11}$/',
            self::FR => '/^FR\d{2}[A-Za-z]{8}$/',
            self::GR => '/^GR\d{11}$/',
        };
    }

    public static function getTax(TaxEnum $enum): int
    {
        return match ($enum) {
            self::DE => 19,
            self::IT => 22,
            self::FR => 20,
            self::GR => 24,
        };
    }
}
