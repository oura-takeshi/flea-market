@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="index-content">
    @if($param != "mylist")
    <div class="heading">
        <p class="heading__index-title">おすすめ</p>
        <a href="/?page=mylist" class="heading__mylist-link">マイリスト</a>
    </div>
    <div class="items">
        @foreach ($items as $item)
        @if($item->user_id != $user_id)
        <div class="item">
            <div class="item__top-content">
                <a href="/item/{{$item->id}}" class="item__link">
                    <img src="{{ asset($item->image) }}" alt="商品画像" class="item__img">
                </a>
                @if($item->purchase != null)
                <div class="item__sold-label">sold</div>
                @endif
            </div>
            <p class="item__name">{{$item->name}}</p>
        </div>
        @endif
        @endforeach
    </div>
    @else
    <div class="heading">
        <a href="/" class="heading__index-link">おすすめ</a>
        <p class="heading__mylist-title">マイリスト</p>
    </div>
    @if (Auth::check())
    <div class="items">
        @foreach ($user_items as $item)
        @if($item->user_id != $user_id && $item->pivot->like == 1)
        <div class="item">
            <div class="item__top-content">
                <a href="/item/{{$item->id}}" class="item__link">
                    <img src="{{ asset($item->image) }}" alt="商品画像" class="item__img">
                </a>
                @if($item->purchase != null)
                <div class="item__sold-label">sold</div>
                @endif
            </div>
            <p class="item__name">{{$item->name}}</p>
        </div>
        @endif
        @endforeach
    </div>
    @endif
    @endif
</div>
@endsection