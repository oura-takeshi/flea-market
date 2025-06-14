@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase_address.css') }}">
@endsection

@section('content')
<div class="content">
    <h1 class="address-form__heading">住所の変更</h1>
    <form action="/purchase/address" class="address-form" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="profile_id" value="{{ $profile_id }}">
        <div class="form__group">
            <label for="post_code" class="form__label">郵便番号</label>
            <div class="form__group-content">
                <div class="form__input-text">
                    <input type="text" name="post_code" id="post_code" value="{{ $post_code }}">
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
                    <input type="text" name="address" id="address" value="{{ $address }}">
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
                    <input type="text" name="building" id="building" value="{{ $building }}">
                </div>
            </div>
        </div>
        <button class="form__button-submit" type="submit">更新する</button>
    </form>
</div>
@endsection