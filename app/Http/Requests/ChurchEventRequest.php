<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChurchEventRequest extends FormRequest
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
            'name' => 'required|string',
            'description' => 'nullable|string',
            'short_description' => 'required|string',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'location' => 'required|string',
            'type' => 'required|string',
        ];
        if ($this->route()->getName() === 'churchevents.store') {
            $rules['picture'] = 'required|image|mimes:jpeg,png,jpg,gif|max:2048';
        } else {
            $rules['picture'] = 'sometimes|nullable|image|mimes:jpeg,png,jpg,gif|max:2048';
        }
        return $rules;
    }
}
