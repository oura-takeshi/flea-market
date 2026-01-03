@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="content">
    @if($param != "mylist")
    <div class="heading">
        <p class="heading__index-title">おすすめ</p>
        <a href="/?page=mylist" class="heading__mylist-link">マイリスト</a>
    </div>
    <div class="items">
        @foreach ($not_have_items as $item)
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
        @endforeach
    </div>
    @else
    <div class="heading">
        <a href="/" class="heading__index-link">おすすめ</a>
        <p class="heading__mylist-title">マイリスト</p>
    </div>
    @if(Auth::check())
    <div class="items">
        @foreach ($like_items as $item)
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
        @endforeach
    </div>
    @endif
    @endif
</div>
@endsection