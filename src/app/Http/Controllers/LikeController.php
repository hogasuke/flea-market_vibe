<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Like;

class LikeController extends Controller
{
    public function toggle(Item $item)
    {
        $like = Like::where('user_id', auth()->id())
            ->where('item_id', $item->id)
            ->first();

        if ($like) {
            $like->delete();
        } else {
            Like::create([
                'user_id' => auth()->id(),
                'item_id' => $item->id,
            ]);
        }

        return back();
    }
}
