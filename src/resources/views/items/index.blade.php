@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
    <div class="item-index">
        <div class="item-index__tabs">
            <a class="item-index__tab {{ $tab !== 'mylist' ? 'item-index__tab--active' : '' }}" href="/">おすすめ</a>
            <a class="item-index__tab {{ $tab === 'mylist' ? 'item-index__tab--active' : '' }}" href="{{ route('items.index', ['tab' => 'mylist']) }}">マイリスト</a>
        </div>

        <div class="item-grid">
            @foreach ($items as $item)
                <a class="item-card" href="{{ route('items.show', $item->id) }}">
                    <article>
                        <div class="item-card__image">
                            @if ($item->purchases)
                                <span class="item-card__sold">Sold</span>
                            @endif
                            <img src="{{ $item->image_path }}" alt="{{ $item->name }}">
                        </div>
                        <p class="item-card__name">{{ $item->name }}</p>
                    </article>
                </a>
            @endforeach
        </div>
    </div>
@endsection
