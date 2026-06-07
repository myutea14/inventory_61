<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'name' => strip_tags(trim($this->name)),
        ]);
    }

    public function rules(): array
    {
        // Mengabaikan ID kategori saat ini untuk validasi unique sewaktu update
        $categoryId = $this->route('category');

        return [
            'name' => 'sometimes|required|string|max:255|unique:categories,name,' . $categoryId,
        ];
    }

protected function prepareForValidation()
{
    $this->merge([
        'name' => strip_tags(trim($this->name)),
        'description' => strip_tags(trim($this->description)),
    ]);
}
}