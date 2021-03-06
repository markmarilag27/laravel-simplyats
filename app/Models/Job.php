<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\JobStatus;
use App\Models\Traits\HasUuid;
use App\QueryFilters\Sort;
use App\QueryFilters\Job\Title;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pipeline\Pipeline;

class Job extends Model
{
    use HasFactory, HasUuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'uuid',
        'title',
        'location',
        'environment',
        'type',
        'experience',
        'description',
        'status',
        'user_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'id',
        'user_id'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [];

    /*
     *******************************************************************************
     * Eloquent Relationships
     * @doc https://laravel.com/docs/8.x/eloquent-relationships
     *******************************************************************************
     */

    /**
     * Get the author of the posted job
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the applicants of the posted job
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function applicants(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Applicant::class);
    }

    /*
     *******************************************************************************
     * Local scopes
     * @doc https://laravel.com/docs/8.x/eloquent#local-scopes
     *******************************************************************************
     */

    /**
     * Get the active jobs
     *
     * @param Builder $query
     * @returns void
     */
    public function scopeOnlyActive(Builder $query): void
    {
        $query->where('status', JobStatus::ACTIVE);
    }

    /**
     * Filter result
     *
     * @param Builder $query
     * @return mixed
     */
    public function scopeHasFiltered(Builder $query): mixed
    {
        return app(Pipeline::class)
            ->send($query)
            ->through([
                Title::class,
                Sort::class
            ])
            ->thenReturn();
    }
}
