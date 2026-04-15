<?php

namespace App\Http\Controllers;

use App\Models\Item;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::latest()->get();

        return view('items.index', compact('items'));
    }

    public function show(Item $item)
    {
        $item->load([
            'categories',
            'comments.user',
        ])->loadCount([
            'likes',
            'comments',
        ]);

        return view('items.show', compact('item'));
    }
}
