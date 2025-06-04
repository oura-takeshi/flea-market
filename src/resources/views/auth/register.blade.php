@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="content">
    <h1 class="register-form__heading">会員登録</h1>
    <form class="register-form" action="/register" method="post" novalidate>
        @csrf
        <div class="form__group">
            <label class="form__label" for="name">ユーザー名</label>
            <div class="form__group-content">
                <div class="form__input-text">
                    <input type="text" name="name" id="name" value="{{ old('name') }}">
                </div>
                <div class="form__error">
                    @error('name')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
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
        <div class="form__group">
            <label class="form__label" for="password_confirmation">確認用パスワード</label>
            <div class="form__group-content">
                <div class="form__input-text">
                    <input type="password" name="password_confirmation" id="password_confirmation">
                </div>
                <div class="form__error">
                    @error('password_confirmation')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <button class="form__button-submit" type="submit">登録する</button>
    </form>
    <a class="login__button-submit" href="/login">ログインはこちら</a>
</div>
@endsection