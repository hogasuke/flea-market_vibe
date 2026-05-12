<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Item;
use App\Models\User;
use Illuminate\Database\Seeder;

class ItemTableSeeder extends Seeder
{
    public function run(): void
    {
        $testUser = User::where('email', 'test@example.com')->firstOrFail();
        $cats = Category::all()->keyBy('name');

        $items = [
            [
                'name'        => '腕時計',
                'price'       => 15000,
                'brand_name'  => 'Rolex',
                'description' => 'スタイリッシュなデザインのメンズ腕時計',
                'image_path'  => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Armani+Mens+Clock.jpg',
                'condition'   => '良好',
                'categories'  => ['メンズ'],
            ],
            [
                'name'        => 'HDD',
                'price'       => 5000,
                'brand_name'  => '西芝',
                'description' => '高速で信頼性の高いハードディスク',
                'image_path'  => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/HDD+Hard+Disk.jpg',
                'condition'   => '目立った傷や汚れなし',
                'categories'  => ['家電・スマホ・カメラ'],
            ],
            [
                'name'        => '玉ねぎ3束',
                'price'       => 300,
                'brand_name'  => '',
                'description' => '新鮮な玉ねぎ３束のセット',
                'image_path'  => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/iLoveIMG+d.jpg',
                'condition'   => 'やや傷や汚れあり',
                'categories'  => ['食品・飲料・酒'],
            ],
            [
                'name'        => '革靴',
                'price'       => 4000,
                'brand_name'  => '',
                'description' => 'クラシックなデザインの革靴',
                'image_path'  => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Leather+Shoes+Product+Photo.jpg',
                'condition'   => '状態が悪い',
                'categories'  => ['メンズ'],
            ],
            [
                'name'        => 'ノートPC',
                'price'       => 45000,
                'brand_name'  => '',
                'description' => '高性能なノートパソコン',
                'image_path'  => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Living+Room+Laptop.jpg',
                'condition'   => '良好',
                'categories'  => ['家電・スマホ・カメラ'],
            ],
            [
                'name'        => 'マイク',
                'price'       => 8000,
                'brand_name'  => '',
                'description' => '高音質のレコーディング用マイク',
                'image_path'  => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Music+Mic+4632231.jpg',
                'condition'   => '目立った傷や汚れなし',
                'categories'  => ['家電・スマホ・カメラ'],
            ],
            [
                'name'        => 'ショルダーバッグ',
                'price'       => 3500,
                'brand_name'  => '',
                'description' => 'おしゃれなショルダーバッグ',
                'image_path'  => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Purse+fashion+pocket.jpg',
                'condition'   => 'やや傷や汚れあり',
                'categories'  => ['レディース'],
            ],
            [
                'name'        => 'タンブラー',
                'price'       => 500,
                'brand_name'  => '',
                'description' => '使いやすいタンブラー',
                'image_path'  => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Tumbler+souvenir.jpg',
                'condition'   => '状態が悪い',
                'categories'  => ['インテリア・住まい・小物'],
            ],
            [
                'name'        => 'コーヒーミル',
                'price'       => 4000,
                'brand_name'  => 'Starbucks',
                'description' => '手動のコーヒーミル',
                'image_path'  => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Waitress+with+Coffee+Grinder.jpg',
                'condition'   => '良好',
                'categories'  => ['インテリア・住まい・小物'],
            ],
            [
                'name'        => 'メイクセット',
                'price'       => 2500,
                'brand_name'  => '',
                'description' => '便利なメイクアップセット',
                'image_path'  => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/%E5%A4%96%E5%87%BA%E3%83%A1%E3%82%A4%E3%82%AF%E3%82%A2%E3%83%83%E3%83%95%E3%82%9A%E3%82%BB%E3%83%83%E3%83%88.jpg',
                'condition'   => '目立った傷や汚れなし',
                'categories'  => ['コスメ・美容', 'レディース'],
            ],
        ];

        foreach ($items as $data) {
            $categoryNames = $data['categories'];
            unset($data['categories']);

            $item = Item::create(array_merge($data, ['user_id' => $testUser->id]));

            $categoryIds = $cats->only($categoryNames)->pluck('id')->toArray();
            $item->categories()->attach($categoryIds);
        }

    }
}
