<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCourseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->role === 'admin';
    }

    public function rules(): array
    {
        // Get the course ID from the route for the unique check
        $courseId = $this->route('course')->id;

        return [
            'title' => 'required|max:255|unique:courses,title,' . $courseId,
            'description' => 'required',
            'price' => 'required|numeric|min:0',
            'thumbnail' => 'nullable|image|max:2048',
        ];
    }
}