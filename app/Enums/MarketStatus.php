<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class MarketStatus extends Enum
{
    const IN_ACTIVE = 0;
    const ACTIVE = 1;


    public static function getDescription($value): string
    {
        if ($value === self::ACTIVE) {
            return trans('api/dashborad/market.active');
        } elseif ($value === self::IN_ACTIVE) {
            return trans('api/dashborad/market.in_active');
        }

        return parent::getDescription($value);
    }
}
