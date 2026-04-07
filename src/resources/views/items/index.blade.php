@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
    @php
        $items = collect(range(1, 7))->map(fn($number) => ['name' => '商品名', 'id' => $number]);
    @endphp

    <div class="item-index">
        <div class="item-index__tabs">
            <a class="item-index__tab item-index__tab--active" href="/">おすすめ</a>
            <span class="item-index__tab">マイリスト</span>
        </div>

        <div class="item-grid">
            @foreach ($items as $item)
                <a class="item-card" href="{{ route('items.show', $item['id']) }}">
                    <article>
                        <div class="item-card__image">商品画像</div>
                        <p class="item-card__name">{{ $item['name'] }}</p>
                    </article>
                </a>
            @endforeach
        </div>
    </div>
@endsection
