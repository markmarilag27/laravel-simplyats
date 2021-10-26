<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobApplicationRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'job_id'        => 'required',
            'first_name'    => 'required|string|min:3|max:255',
            'last_name'     => 'required|string|min:3|max:255',
            'location'      => 'required|string|min:3|max:255',
            'email'         => 'required|string|email|max:255',
            'phone'         => 'required|string|min:9|max:12',
            'cv'            => 'required|mimes:pdf,doc,docx,jpg,png'
        ];
    }
}
