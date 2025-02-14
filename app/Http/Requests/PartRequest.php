<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PartRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $partId = $this->route('part');

        return [
            'name' => 'required|string|max:255',
            'serial_number' => [
                'required',
                'string',
                'max:255',
                'unique:parts,serial_number,' . $partId,
            ],
            'car_id' => 'exists:cars,id|nullable|integer|min:1',
        ];
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.required' => 'The name field is required.',
            'serial_number.required' => 'The serial number field is required.',
            'serial_number.unique' => 'The serial number must be unique.',
            'car_id.required' => 'The car ID field is required.',
            'car_id.exists' => 'The selected car ID does not exist.',
        ];
    }
}
