@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')
<div class="content">
    <div class="top-content">
        <div class="profile-content">
            <div class="profile-info">
                <div class="profile-image">
                    @if($image != null)
                    <img src="{{ asset('storage/' . $image) }}" alt="プロフ画像">
                    @else
                    <div></div>
                    @endif
                </div>
                <h1 class="profile-name">{{ $user_name }}</h1>
            </div>
            <a href="/mypage/profile" class="profile-link">プロフィールを編集</a>
        </div>
        <div class="heading">
            @if($param === "sell")
            <p class="heading__sell para">出品した商品</p>
            @else
            <a href="/mypage?page=sell" class="heading__sell link">出品した商品</a>
            @endif
            @if($param === "buy")
            <p class="heading__buy para">購入した商品</p>
            @else
            <a href="/mypage?page=buy" class="heading__buy link">購入した商品</a>
            @endif
            @if($param === "deal")
            <p class="heading__deal para">取引中の商品
                @if($total_unread_count > 0)
                <span class="heading__total-unread-count">{{ $total_unread_count }}</span>
                @endif
            </p>
            @else
            <a href="/mypage?page=deal" class="heading__deal link">取引中の商品
                @if($total_unread_count > 0)
                <span class="heading__total-unread-count">{{ $total_unread_count }}</span>
                @endif
            </a>
            @endif
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
                    <img src="{{ asset('storage/' . $item->image) }}" alt="商品画像" class="item__img">
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
                    <img src="{{ asset('storage/' . $item->image) }}" alt="商品画像" class="item__img">
                </a>
            </div>
            <p class="item__name">{{$item->name}}</p>
        </div>
        @endif
        @endforeach
        @break
        @case("deal")
        @foreach ($active_chats as $chat)
        <div class="item">
            <div class="item__top-content">
                <a href="/chat/{{$chat->id}}" class="item__link">
                    <img src="{{ asset('storage/' . $chat->purchase->item->image) }}" alt="商品画像" class="item__img">
                </a>
                @if ($chat->unread_count > 0)
                <a href="/chat/{{$chat->id}}" class="item__unread-mark">{{ $chat->unread_count }}</a>
                @endif
            </div>
            <p class="item__name">{{$chat->purchase->item->name}}</p>
        </div>
        @endforeach
        @break
        @default
        @endswitch
    </div>
</div>
@endsection