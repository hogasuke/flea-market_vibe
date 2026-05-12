<?php

namespace App\Http\Controllers;

use App\Http\Requests\SellRequest;
use App\Models\Category;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    public function index()
    {
        $keyword = trim((string) request('keyword'));
        $tab = request('tab', 'recommend');

        $purchasedItemIds = auth()->check()
            ? auth()->user()->purchases()->pluck('item_id')->toArray()
            : [];

        if ($tab === 'mylist') {
            if (!auth()->check()) {
                return redirect()->route('login');
            }

            $items = Item::query()
                ->whereHas('likes', fn($q) => $q->where('user_id', auth()->id()))
                ->latest()
                ->get();

            return view('items.index', compact('items', 'tab', 'purchasedItemIds'));
        }

        $itemsQuery = Item::query()->latest();

        if ($keyword !== '') {
            $itemsQuery->where('name', 'like', '%' . $keyword . '%');
        }

        $items = $itemsQuery->get();

        return view('items.index', compact('items', 'tab', 'purchasedItemIds'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('items.sell', compact('categories'));
    }

    public function store(SellRequest $request)
    {
        $path = $request->file('image')->store('items', 'public');

        $item = Item::create([
            'user_id'     => Auth::id(),
            'name'        => $request->name,
            'brand_name'  => $request->brand_name,
            'description' => $request->description,
            'price'       => $request->price,
            'image_path'  => 'storage/' . $path,
            'condition'   => $request->condition,
        ]);

        $item->categories()->attach($request->categories);

        return redirect('/');
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
