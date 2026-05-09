<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::with('category')->get();
        return response()->json($items);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'item_name' => 'required|string',
            'price' => 'required|integer',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id'
        ]);

        $item = Item::create($validated);
        return response()->json($item, 201);
    }

    public function show(Item $item)
    {
        return response()->json($item->load('category'));
    }

    public function update(Request $request, Item $item)
    {
        $item->update($request->all());
        return response()->json($item);
    }

    public function destroy(Item $item)
    {
        $item->delete();
        return response()->json(['message' => 'Item deleted successfully']);
    }
}