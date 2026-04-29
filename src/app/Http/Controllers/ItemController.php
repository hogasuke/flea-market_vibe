<?php

namespace App\Http\Controllers;

use App\Models\Item;

class ItemController extends Controller
{
    public function index()
    {
        $keyword = trim((string) request('keyword'));
        $tab = request('tab', 'recommend');

        if ($tab === 'mylist') {
            if (!auth()->check()) {
                return redirect()->route('login');
            }

            $items = Item::query()
                ->with('purchases')
                ->whereHas('likes', fn($q) => $q->where('user_id', auth()->id()))
                ->latest()
                ->get();

            return view('items.index', compact('items', 'tab'));
        }

        $itemsQuery = Item::query()
            ->with('purchases')
            ->latest();

        if ($keyword !== '') {
            $itemsQuery->where('name', 'like', '%' . $keyword . '%');
        }

        $items = $itemsQuery->get();

        return view('items.index', compact('items', 'tab'));
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

        $isLiked = auth()->check()
            ? $item->likes()->where('user_id', auth()->id())->exists()
            : false;

        return view('items.show', compact('item', 'isLiked'));
    }
}
