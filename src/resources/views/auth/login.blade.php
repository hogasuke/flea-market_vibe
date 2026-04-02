@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
    <div class="login">
        <div class="login__container">
            <div class="login__heading">
                <h2 class="login__heading-title">ログイン</h2>
            </div>

            <form class="login-form" action="/login" method="post">
                @csrf

                <div class="login-form__group">
                    <label class="login-form__label" for="email">メールアドレス</label>
                    <div class="login-form__input">
                        <input id="email" type="email" name="email" value="{{ old('email') }}">
                    </div>
                    <div class="login-form__error">
                        @error('email')
                            {{ $message }}
                        @enderror
                    </div>
                </div>

                <div class="login-form__group">
                    <label class="login-form__label" for="password">パスワード</label>
                    <div class="login-form__input">
                        <input id="password" type="password" name="password">
                    </div>
                    <div class="login-form__error">
                        @error('password')
                            {{ $message }}
                        @enderror
                    </div>
                </div>

                <div class="login-form__button">
                    <button class="login-form__button-submit" type="submit">ログインする</button>
                </div>
            </form>

            <div class="login__link">
                <a class="login__link-register" href="/register">会員登録はこちら</a>
            </div>
        </div>
    </div>
@endsection