@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage_profile.css') }}">
@endsection

@section('content')
<div class="content">
    <h1 class="profile-form__heading">プロフィール設定</h1>
    <form action="/mypage/profile" class="profile-form" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="user_id" value="{{ $user_id }}">
        <input type="hidden" name="profile_id" value="{{ $profile_id }}">
        <div class="form__group">
            <div class="form__profile-image">
                @if($image != null)
                <img src="{{ asset($image) }}" alt="プロフ画像">
                @else
                <div></div>
                @endif
            </div>
            <div class="form__select-image">
                <div>
                    <label for="profile_image" class="form__select-button">画像を選択する</label>
                    <input type="file" class="form__input-hidden" name="profile_image" id="profile_image">
                </div>
                <div class="form__error">
                    @error('profile_image')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__group">
            <label for="user_name" class="form__label">ユーザー名</label>
            <div class="form__group-content">
                <div class="form__input-text">
                    <input type="text" name="user_name" id="user_name" value="{{ old('user_name', $user_name) }}">
                </div>
                <div class="form__error">
                    @error('user_name')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__group">
            <label for="post_code" class="form__label">郵便番号</label>
            <div class="form__group-content">
                <div class="form__input-text">
                    <input type="text" name="post_code" id="post_code" value="{{ old('post_code', $post_code) }}">
                </div>
                <div class="form__error">
                    @error('post_code')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__group">
            <label for="address" class="form__label">住所</label>
            <div class="form__group-content">
                <div class="form__input-text">
                    <input type="text" name="address" id="address" value="{{ old('address', $address) }}">
                </div>
                <div class="form__error">
                    @error('address')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__group">
            <label for="building" class="form__label">建物名</label>
            <div class="form__group-content">
                <div class="form__input-text">
                    <input type="text" name="building" id="building" value="{{ old('building', $building) }}">
                </div>
            </div>
        </div>
        <button class="form__button-submit" type="submit">更新する</button>
    </form>
</div>
@endsection