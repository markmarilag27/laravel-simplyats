<?php

declare(strict_types=1);

namespace App\QueryFilters\Applicant;

use App\QueryFilters\Filter;
use Illuminate\Database\Eloquent\Builder;

class Name extends Filter
{
    /**
     * Get the filtered name
     *
     * @param Builder $query
     * @return Builder
     */
    protected function applyFilters(Builder $query): Builder
    {
        /** @var $request */
        $request = request(strtolower($this->filterName()));
        /** @var $term */
        $term = preg_replace('/[^A-Za-z0-9\d]/', '', '[[:<:]]'. $request . '[[:>:]]');
        // Query
        return $query->whereRaw("concat(first_name, '', last_name) RLIKE ?", [$term]);
    }
}
