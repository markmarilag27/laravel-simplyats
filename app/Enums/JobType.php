<?php

declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class JobType extends Enum
{
    public const ALL = 'all';
    public const FULL_TIME = 'full-time';
    public const PART_TIME = 'part-time';
}
