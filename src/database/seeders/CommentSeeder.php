<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Item;
use App\Models\User;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    public function run(): void
    {
        $faker = app(\Faker\Generator::class);
        $users = User::all();
        $items = Item::all();

        foreach ($users as $user) {
            $count = rand(0, 5);
            for ($i = 0; $i < $count; $i++) {
                Comment::create([
                    'user_id' => $user->id,
                    'item_id' => $items->random()->id,
                    'content' => $faker->sentence(),
                ]);
            }
        }
    }
}
