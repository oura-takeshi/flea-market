@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')
<div class="mypage-content">
    <div class="top-content">
        <div class="profile-content">
            <div class="profile-info">
                <div class="profile-image">
                    @if($image != null)
                    <img src="{{ asset($image) }}" alt="プロフ画像">
                    @else
                    <div></div>
                    @endif
                </div>
                <h1 class="profile-name">{{ $user_name }}</h1>
            </div>
            <a href="/mypage/profile" class="profile-link">プロフィールを編集</a>
        </div>
        <div class="heading">
            @switch($param)
            @case("sell")
            <p class="heading__sell-title">出品した商品</p>
            <a href="/mypage?page=buy" class="heading__buy-link">購入した商品</a>
            @break
            @case("buy")
            <a href="/mypage?page=sell" class="heading__sell-link">出品した商品</a>
            <p class="heading__buy-title">購入した商品</p>
            @break
            @default
            <a href="/mypage?page=sell" class="heading__sell-link">出品した商品</a>
            <a href="/mypage?page=buy" class="heading__buy-link">購入した商品</a>
            @endswitch
        </div>
    </div>
    <div class="items">
        @switch($param)
        @case("sell")
        @foreach ($items as $item)
        @if($item->user_id == $user_id)
        <div class="item">
            <div class="item__top-content">
                <a href="/item/{{$item->id}}" class="item__link">
                    <img src="{{ asset($item->image) }}" alt="商品画像" class="item__img">
                </a>
                @if($item->purchase != null)
                <a href="/item/{{$item->id}}" class="item__sold-label">sold</a>
                @endif
            </div>
            <p class="item__name">{{$item->name}}</p>
        </div>
        @endif
        @endforeach
        @break
        @case("buy")
        @foreach ($items as $item)
        @if($item->purchase != null && $item->purchase->user_id == $user_id)
        <div class="item">
            <div class="item__top-content">
                <a href="/item/{{$item->id}}" class="item__link">
                    <img src="{{ asset($item->image) }}" alt="商品画像" class="item__img">
                </a>
            </div>
            <p class="item__name">{{$item->name}}</p>
        </div>
        @endif
        @endforeach
        @break
        @default
        @endswitch
    </div>
</div>
@endsection