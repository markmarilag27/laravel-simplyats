<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\MediaCollection;
use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Applicant extends Model implements HasMedia
{
    use HasFactory, HasUuid, InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'uuid',
        'job_id',
        'first_name',
        'last_name',
        'location',
        'email',
        'phone',
        'links',
        'status'
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
    protected $casts = [
        'links' => 'array'
    ];

    /*
     *******************************************************************************
     * Media Collections
     * @doc https://spatie.be/docs/laravel-medialibrary/v9/working-with-media-collections/defining-media-collections
     *******************************************************************************
     */

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(MediaCollection::CV)->singleFile();
    }

    /*
     *******************************************************************************
     * Eloquent Relationships
     * @doc https://laravel.com/docs/8.x/eloquent-relationships
     *******************************************************************************
     */

    /**
     * CV of applicant
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function curriculumVitae(): \Illuminate\Database\Eloquent\Relations\MorphOne
    {
        return $this->morphOne(Media::class, 'model')
            ->where('collection_name', MediaCollection::CV);
    }

    /*
     *******************************************************************************
     * Local scopes
     * @doc https://laravel.com/docs/8.x/eloquent#local-scopes
     *******************************************************************************
     */
}
