<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            UserTableSeeder::class,
            CategorySeeder::class,
            ItemTableSeeder::class,
            LikeSeeder::class,
            CommentSeeder::class,
            PurchaseSeeder::class,
        ]);
    }
}
