<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddressRequest;
use App\Models\Item;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    public function show(Item $item)
    {
        /** @var User $user */
        $user = Auth::user();
        $address = session('purchase_address', [
            'postal_code' => $user->postal_code,
            'address'     => $user->address,
            'building'    => $user->building,
        ]);
        return view('items.address', compact('item', 'user', 'address'));
    }

    public function update(AddressRequest $request, Item $item): RedirectResponse
    {
        session(['purchase_address' => $request->only(['postal_code', 'address', 'building'])]);

        return redirect()->route('purchase.show', $item);
    }
}
