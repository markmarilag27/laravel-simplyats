<?php

declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class SortType extends Enum
{
    public const ASC = 'asc';
    public const DESC = 'desc';
}
