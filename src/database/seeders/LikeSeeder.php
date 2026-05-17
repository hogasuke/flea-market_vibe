<?php

namespace Database\Seeders;

use App\Models\Item;
use App\Models\Like;
use App\Models\User;
use Illuminate\Database\Seeder;

class LikeSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $items = Item::all();

        foreach ($users as $user) {
            $likeableItems = $items->filter(fn($item) => $item->user_id !== $user->id);
            $count = rand(0, min(5, $likeableItems->count()));
            if ($count === 0) {
                continue;
            }

            $likeableItems->random($count)->each(function ($item) use ($user) {
                Like::create([
                    'user_id' => $user->id,
                    'item_id' => $item->id,
                ]);
            });
        }
    }
}
