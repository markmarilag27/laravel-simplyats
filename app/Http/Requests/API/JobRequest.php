<?php

declare(strict_types=1);

namespace App\Http\Requests\API;

use App\Enums\JobEnvironment;
use App\Enums\JobExperience;
use App\Enums\JobStatus;
use App\Enums\JobType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class JobRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'title'         => 'required|string|min:3|max:255',
            'location'      => 'required|string',
            'environment'   => [
                'required',
                'string',
                Rule::in(JobEnvironment::getValues())
            ],
            'type'          => [
                'required',
                'string',
                Rule::in(JobType::getValues())
            ],
            'experience'    => [
                'required',
                'string',
                Rule::in(JobExperience::getValues())
            ],
            'description'   => 'required|string',
            'status'        => [
                'required',
                'string',
                Rule::in(JobStatus::getValues())
            ]
        ];
    }
}
