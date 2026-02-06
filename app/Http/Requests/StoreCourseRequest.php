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
        // Only allow admins to use this (Double check security)
        return auth()->check() && auth()->user()->role === 'admin';
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
            'thumbnail' => 'nullable|image|max:2048', // Max 2MB
        ];
    }
}