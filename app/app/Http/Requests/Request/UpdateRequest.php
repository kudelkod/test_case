<?php

namespace App\Http\Requests\Request;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'status' => [
                'string',
                'required',
                'in:Resolved,Active'
            ],

            'comment' => [
                'string',
                'required_if:status,Resolved'
            ],
        ];
    }

    public function messages()
    {
        return [
            'status.required' => 'Status field is required',
            'status.in' => 'Status field must be in [Resolved, Active]',
            'comment.required_if' => 'Comment field required if Status field = Resolved'
        ];
    }
}
