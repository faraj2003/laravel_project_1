<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCourseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Fix: Return true because the route in web.php is already protected by 'auth:admin'
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'title' => 'required|unique:courses,title|max:255',
            'description' => 'required',
            'price' => 'required|numeric|min:0',
            // 'thumbnail' is correct because your migration and model use that name
            'thumbnail' => 'nullable|image|max:2048', // Max 2MB
        ];
    }
}