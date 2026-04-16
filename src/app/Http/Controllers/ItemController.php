<?php

namespace App\Http\Controllers;

use App\Models\Item;

class ItemController extends Controller
{
    public function index()
    {
        $keyword = trim((string) request('keyword'));

        $itemsQuery = Item::query()
            ->with('purchases')
            ->latest();

        if ($keyword !== '') {
            $itemsQuery->where('name', 'like', '%' . $keyword . '%');
        }

        if (auth()->check()) {
            $itemsQuery->where('user_id', '!=', auth()->id());
        }

        $items = $itemsQuery->get();

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
