<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateResearchTitleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
           'title' => [
    'required',
    'string',
    'max:255',
    Rule::unique('research_titles', 'title')->ignore($this->route('research_title')->id),
],

            'author_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'category_id' => 'required|exists:categories,id',
            'photo' => 'nullable|image|mimes:jpeg,png|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Research title is required.',
            'title.unique' => 'This research title already exists.',
            'author_name.required' => 'Author name is required.',
            'email.required' => 'Email address is required.',
            'email.email' => 'Please provide a valid email address.',
            'category_id.required' => 'Please select a category.',
            'category_id.exists' => 'The selected category is invalid.',
            'photo.image' => 'The file must be an image.',
            'photo.mimes' => 'Only JPG and PNG images are allowed.',
            'photo.max' => 'The image must not exceed 2MB.',
        ];
    }
}
