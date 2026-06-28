<?php

namespace App\Services;

use App\Models\Item;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log; // <-- Wajib ada agar fungsi Log bisa dipanggil

class ItemService 
{
    public function all(): Collection 
    {
        return Item::with('category')->get();
    }

    public function find(int $id): Item 
    {
        return Item::with('category')->findOrFail($id);
    }

    public function create(array $data): Item 
    {
        // 1. Simpan hasil pembuatan item ke dalam variabel $item
        $item = Item::create($data);

        // 2. Sekarang $item sudah ada, jadi log-nya bisa membaca $item->id
        Log::info('Item created', ['id' => $item->id, 'data' => $data]);

        // 3. Kembalikan nilainya
        return $item;
    }

    public function update(int $id, array $data): Item 
    {
        $item = Item::findOrFail($id);
        $item->update($data);
        
        // Catat ke log setelah data berhasil diupdate
        Log::info('Item updated', ['id' => $id, 'changes' => $data]);
        
        return $item;
    }

    public function delete(int $id): void 
    {
        Item::destroy($id);
        
        // Catat ke log setelah data berhasil dihapus
        Log::info('Item deleted', ['id' => $id]);
    }
}