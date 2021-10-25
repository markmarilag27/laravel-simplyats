<?php

declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class JobEnvironment extends Enum
{
    public const ON_SITE = 'on-site';
    public const REMOTE = 'remote';
    public const HYBRID = 'hybrid';
}
