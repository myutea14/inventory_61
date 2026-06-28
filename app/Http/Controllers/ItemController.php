<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Services\ItemService; // <-- Ini wajib dipanggil
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Exception;

class ItemController extends BaseController
{
    // Deklarasikan service-nya di sini
    protected ItemService $svc;

    public function __construct(ItemService $svc)
    {
        $this->svc = $svc;
    }

    public function index(Request $request): JsonResponse 
    {
        // Pakai service untuk mengambil semua data
        return $this->success($this->svc->all(), 'Berhasil mengambil data item.');
    }

    public function store(StoreItemRequest $request): JsonResponse
    {
        try {
            $item = $this->svc->create($request->validated());
            return $this->success($item, 'Item berhasil dibuat.', 201);
        } catch (Exception $e) {
            return $this->error('Gagal membuat item.', 500, [$e->getMessage()]);
        }
    }

    public function show($id): JsonResponse
    {
        try {
            $item = $this->svc->find($id);
            return $this->success($item, 'Berhasil mengambil data item.');
        } catch (Exception $e) {
            return $this->error('Item tidak ditemukan.', 404);
        }
    }

    public function update(UpdateItemRequest $request, $id): JsonResponse
    {
        try {
            // Proses update diserahkan ke service
            $item = $this->svc->update($id, $request->validated());
            return $this->success($item, 'Item berhasil diperbarui.');
        } catch (Exception $e) {
            return $this->error('Gagal memperbarui item.', 500, [$e->getMessage()]);
        }
    }

    public function destroy($id): JsonResponse
    {
        try {
            // Proses delete diserahkan ke service
            $this->svc->delete($id);
            return $this->success(null, 'Item berhasil dihapus.');
        } catch (Exception $e) {
            return $this->error('Item tidak ditemukan atau gagal dihapus.', 404, [$e->getMessage()]);
        }
    }
}