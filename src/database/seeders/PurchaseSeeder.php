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

        // テストユーザーが他ユーザーの出品商品を購入（テストユーザーの購入した商品）
        $otherUserItems = Item::whereIn('user_id', $otherUsers->pluck('id'))->get();
        $boughtItems = $otherUserItems->random(min(2, $otherUserItems->count()));

        $buyerIndex = 0;
        foreach ($boughtItems as $item) {
            Purchase::create([
                'user_id'        => $testUser->id,
                'item_id'        => $item->id,
                'payment_method' => $paymentMethods[$buyerIndex % 2],
                'postal_code'    => '200-000' . $buyerIndex,
                'address'        => '大阪府大阪市' . ($buyerIndex + 1) . '丁目',
                'building'       => null,
            ]);
            $buyerIndex++;
        }

    }
}
