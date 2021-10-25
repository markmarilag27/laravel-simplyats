<?php

declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class JobStatus extends Enum
{
    public const ACTIVE = 'active';
    public const PENDING = 'pending';
    public const CLOSED = 'closed';
}
