<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
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
            'user_id' => 'required|array',
            'user_id.*' => 'exists:users,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|string|in:To Do,Work In Progress,Under Review,Complete',
            'due_date' => 'required|date_format:Y-m-d',
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.required' => 'Please select at least one user.',
            'user_id.*.exists' => 'One or more selected users do not exist.',
            'status.in' => 'The status must be one of the following: To Do, Work In Progress, Under Review, Complete',
        ];
    }
}
