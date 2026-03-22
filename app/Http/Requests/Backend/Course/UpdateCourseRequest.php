<?php

namespace App\Http\Requests\Backend\Course;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCourseRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'sometimes|required|numeric|min:0',
            'thumbnail' => 'nullable|image|max:2048',
            'category_id' => 'required|exists:categories,id',
            'career_path' => 'nullable|string|max:255',
            'tags' => 'nullable|string',
            'instructor_ids' => 'required|array',
            'instructor_ids.*' => 'exists:users,id',
            'status' => 'nullable|in:draft,published,pending_approval,rejected',
            'is_featured' => 'nullable|boolean',
        ];
    }
}
