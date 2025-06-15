@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/sell.css') }}">
@endsection

@section('content')
<div class="content">
    <h1 class="item-form__heading">商品の出品</h1>
    <form class="item-form" action="/exhibition" method="post">
        @csrf
        <div class="form__group">
            <div class="form__group-body">
                <div class="form__unit">
                    <label class="form__unit-label" for="">商品画像</label>
                    <div class="form__unit-content">
                        <div class="form__input-file">
                            <label for="image">画像を選択する</label>
                            <input type="file" name="image" id="image">
                        </div>
                        <div class="form__error">
                            @error('image')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form__group">
            <h2 class="form__group-title">商品の詳細</h2>
            <div class="form__group-body">
                <div class="form__unit category">
                    <label class="form__unit-label" for="">カテゴリー</label>
                    <div class="form__unit-content">
                        <div class="form__input-checkbox">
                            @foreach ($categories as $category)
                            <input type="checkbox" name="category_id[]" id="{{ $category->id }}">
                            <label for="{{ $category->id }}">{{ $category->content }}</label>
                            @endforeach
                        </div>
                        <div class="form__error">
                            @error('category_id')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form__unit">
                    <label class="form__unit-label" for="condition_id">商品の状態</label>
                    <div class="form__unit-content">
                        <select class="form__select" name="condition_id" id="condition_id">
                            <option selected hidden value="">選択してください</option>
                            @foreach ($conditions as $condition)
                            <option value="{{ $condition->id }}">{{ $condition->content }}</option>
                            @endforeach
                        </select>
                        <div class="form__error">
                            @error('condition_id')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form__group">
            <h2 class="form__group-title">商品名と説明</h2>
            <div class="form__group-body">
                <div class="form__unit">
                    <label class="form__unit-label" for="name">商品名</label>
                    <div class="form__unit-content">
                        <div class="form__input-text">
                            <input type="text" id="name" name="name">
                        </div>
                        <div class="form__error">
                            @error('name')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form__unit">
                    <label class="form__unit-label" for="brand">ブランド名</label>
                    <div class="form__unit-content">
                        <div class="form__input-text">
                            <input type="text" id="brand" name="brand">
                        </div>
                    </div>
                </div>
                <div class="form__unit">
                    <label class="form__unit-label" for="description">商品の説明</label>
                    <div class="form__unit-content">
                        <div class="form__textarea">
                            <textarea name="description" id="description"></textarea>
                        </div>
                        <div class="form__error">
                            @error('description')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form__unit">
                    <label class="form__unit-label" for="price">販売価格</label>
                    <div class="form__unit-content">
                        <div class="form__input-text yen">
                            <input type="text" id="price" name="price">
                        </div>
                        <div class="form__error">
                            @error('price')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button class="form__button-submit" type="submit">出品する</button>
    </form>
</div>
@endsection