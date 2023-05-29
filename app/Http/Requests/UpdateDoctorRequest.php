<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class UpdateDoctorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'specialist_id' => 'sometimes|required|exists:specialists,id',
            'name' => 'sometimes|required|string',
            'photo' => 'nullable',
            'location' => 'sometimes|required',
            'price' => 'integer',
            'review' => 'nullable',
            'star' => 'numeric',
            'total_review' => 'integer',
        ];
    }
}
