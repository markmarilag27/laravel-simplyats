<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    protected $hidden = ['id'];

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
}
