<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Exception;
use Illuminate\Http\JsonResponse;

class CategoryController extends BaseController
{

    public function index(): JsonResponse
    {
        $categories = Category::all();
        return $this->success($categories, 'Berhasil mengambil semua data kategori.');
    }

    public function store(StoreCategoryRequest $request): JsonResponse
    {
        try {
            $category = Category::create($request->validated());
            return $this->success($category, 'Kategori berhasil dibuat.', 201);
        } catch (Exception $e) {
            return $this->error('Gagal membuat kategori.', 500, [$e->getMessage()]);
        }
    }

    public function show($id): JsonResponse
    {
        $category = Category::find($id);

        if (!$category) {
            return $this->error('Kategori tidak ditemukan.', 404);
        }

        return $this->success($category, 'Berhasil mengambil data kategori.');
    }

    public function update(UpdateCategoryRequest $request, $id): JsonResponse
    {
        try {
            $category = Category::find($id);

            if (!$category) {
                return $this->error('Kategori tidak ditemukan untuk diperbarui.', 404);
            }

            $category->update($request->validated());
            return $this->success($category, 'Kategori berhasil diperbarui.');
        } catch (Exception $e) {
            return $this->error('Gagal memperbarui kategori.', 500, [$e->getMessage()]);
        }
    }

    public function destroy($id): JsonResponse
    {
        $category = Category::find($id);

        if (!$category) {
            return $this->error('Kategori tidak ditemukan.', 404);
        }

        $category->delete();
        return $this->success(null, 'Kategori berhasil dihapus.');
    }
}