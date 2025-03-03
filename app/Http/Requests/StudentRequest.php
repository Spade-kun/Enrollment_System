<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
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
        $rules = [
            'name' => 'required|string|max:255',
            'year_level' => 'required|integer|min:1|max:6',
            'course' => 'required|string|in:BSIT,BSCS,BSCE,BSEd,BSBA',
        ];

        if ($this->isMethod('post')) {
            // Additional rules for storing a new student
            $rules['email'] = 'required|email|exists:users,email';
        }

        return $rules;
    }
} 