<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LimitRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'limit' => 'required|numeric',
        ];
    }
}
