<?php

declare(strict_types=1);

namespace App\Http\Requests\API;

use App\Enums\ApplicantStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ApplicantApplicationActionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'status' => [
                'required',
                'string',
                Rule::in(ApplicantStatus::getValues())
            ]
        ];
    }
}
