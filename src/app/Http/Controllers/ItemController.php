<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        return view('items.index');
    }

    public function show($item)
    {
        $item = [
            'id' => $item,
            'name' => '商品名がここに入る',
            'brand' => 'ブランド名',
            'price' => '47,000',
            'likes' => 3,
            'comments' => 1,
            'color' => 'グレー',
            'condition' => '良好',
            'description' => [
                '新品',
                '商品の状態は良好です。傷もありません。',
                '購入後、即発送いたします。',
            ],
            'categories' => ['洋服', 'メンズ'],
            'comment_user' => 'admin',
            'comment_body' => 'こちらにコメントが入ります。',
        ];

        return view('items.show', compact('item'));
    }
}
