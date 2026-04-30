<?php

namespace App\Http\Controllers;

use App\Models\Item;

class PurchaseController extends Controller
{
    public function show(Item $item)
    {
        $user = auth()->user();

        return view('items.purchase', compact('item', 'user'));
    }
}
