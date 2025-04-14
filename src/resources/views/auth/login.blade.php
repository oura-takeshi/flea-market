@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
<div class="login-content">
    <h1 class="login-form__heading">ログイン</h1>
    <form class="login-form" action="/login" method="post">
        @csrf
        <div class="form__group">
            <label class="form__label" for="email">メールアドレス</label>
            <div class="form__group-content">
                <div class="form__input-text">
                    <input type="email" name="email" id="email" value="{{ old('email') }}">
                </div>
                <div class="form__error">
                    @error('email')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__group">
            <label class="form__label" for="password">パスワード</label>
            <div class="form__group-content">
                <div class="form__input-text">
                    <input type="password" name="password" id="password">
                </div>
                <div class="form__error">
                    @error('password')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <button class="form__button-submit" type="submit">ログインする</button>
    </form>
    <a class="login__button-submit" href="/register">会員登録はこちら</a>
</div>
@endsection