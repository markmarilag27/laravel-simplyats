<?php

declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class ApplicantStatus extends Enum
{
    public const APPROVE = 'approve';
    public const REJECT = 'reject';
}
