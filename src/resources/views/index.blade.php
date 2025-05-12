@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="index-content">
    <p>クエリパラメータは{{$param}}</p>
    <div class="heading">
        @if($param != "mylist")
        <p class="heading__index-title">おすすめ</p>
        <a href="/?page=mylist" class="heading__mylist-link">マイリスト</a>
        @else
        <a href="/" class="heading__index-link">おすすめ</a>
        <p class="heading__mylist-title">マイリスト</p>
        @endif
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
</div>
@endsection