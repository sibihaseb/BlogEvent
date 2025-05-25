<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChurchEventBlogRequest extends FormRequest
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

        return $this->isMethod('post') ? $this->storeRules() : $this->updateRules();
    }

    private function storeRules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'short_description' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ];
    }
    private function updateRules(): array
    {
        return [
            'name' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:255',
            'short_description' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ];
    }
}
