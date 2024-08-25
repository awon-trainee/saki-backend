<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class TransferStatus extends Enum
{
    const PENINDING = 0;
    const APPROVE = 1;
    const REJECT = 2;
}
