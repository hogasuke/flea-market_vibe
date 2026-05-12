<?php

namespace Database\Seeders;

use App\Models\Item;
use App\Models\Purchase;
use App\Models\User;
use Illuminate\Database\Seeder;

class PurchaseSeeder extends Seeder
{
    public function run(): void
    {
        $testUser = User::where('email', 'test@example.com')->firstOrFail();
        $otherUsers = User::where('email', '!=', 'test@example.com')->get();

        $paymentMethods = ['カード払い', 'コンビニ払い'];

        // 他ユーザーがテストユーザーの出品商品を購入（テストユーザーの売れた商品）
        $testUserItems = Item::where('user_id', $testUser->id)->get();
        $soldItems = $testUserItems->random(min(3, $testUserItems->count()));

        foreach ($soldItems as $index => $item) {
            $buyer = $otherUsers[$index % $otherUsers->count()];
            Purchase::create([
                'user_id'        => $buyer->id,
                'item_id'        => $item->id,
                'payment_method' => $paymentMethods[$index % 2],
                'postal_code'    => '100-000' . $index,
                'address'        => '東京都千代田区' . ($index + 1) . '丁目',
                'building'       => null,
            ]);
        }

    }
}
