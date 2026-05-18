<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Purchase;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function show(Item $item)
    {
        $user = auth()->user();
        $address = session('purchase_address', [
            'postal_code' => $user->postal_code,
            'address'     => $user->address,
            'building'    => $user->building,
        ]);

        return view('items.purchase', compact('item', 'user', 'address'));
    }

    public function store(Request $request, Item $item): RedirectResponse
    {
        $request->validate([
            'payment_method' => ['required'],
        ], [
            'payment_method.required' => '支払い方法を選択してください',
        ]);

        $user = auth()->user();
        $address = session('purchase_address', [
            'postal_code' => $user->postal_code,
            'address'     => $user->address,
            'building'    => $user->building,
        ]);

        Purchase::create([
            'user_id'        => $user->id,
            'item_id'        => $item->id,
            'payment_method' => $request->input('payment_method'),
            'postal_code'    => $address['postal_code'],
            'address'        => $address['address'],
            'building'       => $address['building'] ?? null,
        ]);

        session()->forget('purchase_address');

        return redirect()->route('items.index');
    }
}
