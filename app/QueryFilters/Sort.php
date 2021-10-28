<?php

declare(strict_types=1);

namespace App\QueryFilters;

use App\Enums\SortColumn;
use App\Enums\SortType;
use Illuminate\Database\Eloquent\Builder;

class Sort extends Filter
{
    /**
     * Filter result by sort
     *
     * @param Builder $query
     * @return Builder
     */
    protected function applyFilters(Builder $query): Builder
    {
        /** @var $request */
        $request = request(strtolower($this->filterName()));

        return match ($request) {
            SortType::ASC   => $query->oldest(SortColumn::ID),
            SortType::DESC  => $query->latest(SortColumn::ID)
        };
    }
}
