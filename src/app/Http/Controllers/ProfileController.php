<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show()
    {
        /** @var User $user */
        $user = Auth::user();
        return view('profile', compact('user'));
    }

    public function update(ProfileRequest $request): RedirectResponse
    {
        /** @var User $user */
        $user = Auth::user();

        $data = $request->only(['name', 'postal_code', 'address', 'building']);

        if ($request->hasFile('profile_image')) {
            $path = $request->file('profile_image')->store('profile_images', 'public');
            $data['profile_image'] = $path;
        }

        $user->update($data);

        return redirect('/');
    }
}
