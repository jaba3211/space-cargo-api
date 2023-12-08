<?php

namespace Domains\Parcels\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateParcelRequest extends FormRequest
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
            'code' => 'required|string|max:60|unique:parcels',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'store_address' => 'required|string|max:255',
            'comment' => 'required|string|max:500',
        ];
    }
}
