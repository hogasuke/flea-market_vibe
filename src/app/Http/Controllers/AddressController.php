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
        return view('items.address', compact('item', 'user'));
    }

    public function update(AddressRequest $request, Item $item): RedirectResponse
    {
        /** @var User $user */
        $user = Auth::user();
        $user->update($request->only(['postal_code', 'address', 'building']));

        return redirect()->route('purchase.show', $item);
    }
}
