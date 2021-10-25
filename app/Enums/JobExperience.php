<?php

declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class JobExperience extends Enum
{
    public const ALL = 'all';
    public const JUNIOR = 'junior';
    public const MID = 'mid';
    public const SENIOR = 'senior';
    public const LEAD = 'lead';
}
