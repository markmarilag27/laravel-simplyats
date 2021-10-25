<?php

declare(strict_types=1);

namespace App\Http\Requests\API\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'email'         => 'required|string|max:255|email',
            'password'      => 'required|string|min:8|max:255'
        ];
    }
}
