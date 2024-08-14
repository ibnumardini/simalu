<?php

namespace App\Http\Requests\Alumni;

use Illuminate\Foundation\Http\FormRequest;

class AlumniStoreRequest extends FormRequest
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
        return [
            "mobile" => 'required',
            "address" => 'required',
            "pob" => 'required|string',
            "dob" => 'required|date',
            "registration_at" => 'required|date',
            "graduation_at" => 'required|date',
            "school_id" => 'required',
            "user_id" => 'required',
        ];
    }
}
