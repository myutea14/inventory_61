<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // Pastikan menggunakan item_name sesuai database
            'item_name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
        ];
    }

    // Fungsi untuk sanitasi (menghapus tag HTML)
    protected function prepareForValidation()
    {
        $this->merge([
            'item_name' => strip_tags($this->item_name),
        ]);
    }
}