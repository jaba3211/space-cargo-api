<?php

namespace Domains\Parcels\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateParcelRequest extends FormRequest
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
            'id' => 'required|numeric|exists:parcels,id',
            'code' => [
                'required',
                'string',
                'max:60',
                Rule::unique('parcels')->ignore($this->request->get('id'))
            ],
            'price' => 'required|numeric',
            'quantity' => 'nullable|numeric',
            'store_address' => 'required|string|max:255',
            'comment' => 'nullable|string|max:500',
        ];
    }
}
