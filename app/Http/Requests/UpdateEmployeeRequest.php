<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Allow all users to update
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            //'email' => 'required|email|unique:employees,email,' . $this->route('employee'),
            'email' => 'required|email|unique:employees,email,' . $this->route('id'), // Use 'id' from the route

            'telephone' => ['nullable'],
            'address' => 'nullable|string',
            'title' => 'nullable|string',
        ];
    }
}
