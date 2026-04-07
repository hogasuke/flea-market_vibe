@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/show.css') }}">
@endsection

@section('content')
    <div class="item-detail">
        <div class="item-detail__image">商品画像</div>

        <div class="item-detail__content">
            <section class="item-detail__section item-detail__section--head">
                <h1 class="item-detail__name">{{ $item['name'] }}</h1>
                <p class="item-detail__brand">{{ $item['brand'] }}</p>
                <p class="item-detail__price">¥{{ $item['price'] }}<span>(税込)</span></p>

                <div class="item-detail__meta">
                    <div class="item-detail__meta-item">
                        <span class="item-detail__meta-icon">♡</span>
                        <span class="item-detail__meta-count">{{ $item['likes'] }}</span>
                    </div>
                    <div class="item-detail__meta-item">
                        <span class="item-detail__meta-icon">◯</span>
                        <span class="item-detail__meta-count">{{ $item['comments'] }}</span>
                    </div>
                </div>

                <button class="item-detail__purchase-button" type="button">購入手続きへ</button>
            </section>

            <section class="item-detail__section">
                <h2 class="item-detail__heading">商品説明</h2>

                <div class="item-detail__description">
                    <p>カラー: {{ $item['color'] }}</p>

                    @foreach ($item['description'] as $line)
                        <p>{{ $line }}</p>
                    @endforeach
                </div>
            </section>

            <section class="item-detail__section">
                <h2 class="item-detail__heading">商品の情報</h2>

                <dl class="item-detail__info">
                    <div class="item-detail__info-row">
                        <dt>カテゴリー</dt>
                        <dd>
                            @foreach ($item['categories'] as $category)
                                <span class="item-detail__tag">{{ $category }}</span>
                            @endforeach
                        </dd>
                    </div>
                    <div class="item-detail__info-row">
                        <dt>商品の状態</dt>
                        <dd>{{ $item['condition'] }}</dd>
                    </div>
                </dl>
            </section>

            <section class="item-detail__section">
                <h2 class="item-detail__heading item-detail__heading--comment">コメント({{ $item['comments'] }})</h2>

                <div class="item-detail__comment-user">
                    <span class="item-detail__comment-avatar"></span>
                    <span class="item-detail__comment-name">{{ $item['comment_user'] }}</span>
                </div>

                <div class="item-detail__comment-body">
                    {{ $item['comment_body'] }}
                </div>
            </section>

            <section class="item-detail__section">
                <h2 class="item-detail__comment-title">商品へのコメント</h2>
                <textarea class="item-detail__comment-input"></textarea>
                <button class="item-detail__comment-button" type="button">コメントを送信する</button>
            </section>
        </div>
    </div>
@endsection
