<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'メンズ',
            'レディース',
            'ベビー・キッズ',
            '家電・スマホ・カメラ',
            'インテリア・住まい・小物',
            '食品・飲料・酒',
            'スポーツ・レジャー',
            'コスメ・美容',
            '本・音楽・ゲーム',
            'おもちゃ・ホビー・グッズ',
            'その他',
        ];

        foreach ($categories as $name) {
            Category::create(['name' => $name]);
        }
    }
}
