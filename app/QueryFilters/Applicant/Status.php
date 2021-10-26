<?php

declare(strict_types=1);

namespace App\QueryFilters\Applicant;

use App\Enums\ApplicantStatus;
use App\QueryFilters\Filter;
use Illuminate\Database\Eloquent\Builder;

class Status extends Filter
{
    /**
     * Filter by status
     *
     * @param Builder $query
     * @return Builder
     */
    protected function applyFilters(Builder $query): Builder
    {
        /** @var $request */
        $request = request(strtolower($this->filterName()));

        if (!in_array($request, ApplicantStatus::getValues(), true)) {
            return $query->whereNull('status');
        }

        return $query->where('status', $request);
    }
}
