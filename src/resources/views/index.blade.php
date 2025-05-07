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
        <div class="item">
            <a href="/item/{{$item->id}}" class="item__link"></a>
            <img src="{{ asset($item->image) }}" alt="商品画像" class="item__img">
            <p class="item__name">{{$item->name}}</p>
        </div>
        @endforeach
    </div>
</div>
@endsection