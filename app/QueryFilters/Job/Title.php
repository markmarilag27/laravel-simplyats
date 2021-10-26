<?php

declare(strict_types=1);

namespace App\QueryFilters\Job;

use App\QueryFilters\Filter;
use Illuminate\Database\Eloquent\Builder;

class Title extends Filter
{
    /**
     * Filter by name
     * @param Builder $query
     * @return Builder
     */
    protected function applyFilters(Builder $query): Builder
    {
        /** @var $request */
        $request = request(strtolower($this->filterName()));
        /** @var $term */
        $term = preg_replace('/[^A-Za-z0-9\d]/', '', '[[:<:]]'. $request . '[[:>:]]');
        return $query->where('title', 'RLIKE', $term);
    }
}
