<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Override;

class NoteRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|min:6|max:50',
            'description' => 'required|min:10|max:255',
            'status' => 'required|in:pending,progress,completed,cancelled',
        ];
    }


    public function messages(): array
    {
        return [
            'title.required' => 'Oops! Title required'
        ];
    }
}
