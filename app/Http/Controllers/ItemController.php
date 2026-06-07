<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Models\Item;
use Exception;
use Illuminate\Http\JsonResponse;

class ItemController extends BaseController
{

    public function index(): JsonResponse
    {
        $items = Item::with('category')->get();
        return $this->success($items, 'Berhasil mengambil semua data item.');
    }

    public function store(StoreItemRequest $request): JsonResponse
    {
        try {
            // Data yang masuk sudah otomatis tersanitasi lewat FormRequest
            $item = Item::create($request->validated());
            return $this->success($item, 'Item berhasil dibuat.', 201);
        } catch (Exception $e) {
            return $this->error('Gagal membuat item.', 500, [$e->getMessage()]);
        }
    }

    public function show($id): JsonResponse
    {
        $item = Item::with('category')->find($id);

        if (!$item) {
            return $this->error('Item tidak ditemukan.', 404);
        }

        return $this->success($item, 'Berhasil mengambil data item.');
    }

    public function update(UpdateItemRequest $request, $id): JsonResponse
    {
        try {
            $item = Item::find($id);

            if (!$item) {
                return $this->error('Item tidak ditemukan untuk diperbarui.', 404);
            }

            $item->update($request->validated());
            return $this->success($item, 'Item berhasil diperbarui.');
        } catch (Exception $e) {
            return $this->error('Gagal memperbarui item.', 500, [$e->getMessage()]);
        }
    }

    public function destroy($id): JsonResponse
    {
        $item = Item::find($id);

        if (!$item) {
            return $this->error('Item tidak ditemukan.', 404);
        }

        $item->delete();
        return $this->success(null, 'Item berhasil dihapus.');
    }
}