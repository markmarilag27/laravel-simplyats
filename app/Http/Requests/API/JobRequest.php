<?php

declare(strict_types=1);

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

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
            'environment'   => 'required|string',
            'type'          => 'required|string',
            'experience'    => 'required|string',
            'description'   => 'required|string',
            'status'        => 'required|string'
        ];
    }
}
