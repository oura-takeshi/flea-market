@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/item.css') }}">
@endsection

@section('content')
<div class="content">
    <div class="left-content">
        <img src="{{ asset($item->image) }}" alt="商品画像" class="item__img">
        @if($item->purchase != null)
        <div class="item__sold-label">sold</div>
        @endif
    </div>
    <div class="right-content">
        <div class="item__group">
            <h1 class="item__name">{{ $item->name }}</h1>
            <p class="item__brand">{{ $item->brand }}</p>
        </div>
        <div class="item__group">
            <p class="item__price">&yen<span class="item__price-span">{{ number_format($item->price) }}</span>(税込)</p>
        </div>
        <div class="icons">
            <div class="icon">
                @if($user_like == null)
                @if(Auth::check())
                <label class="icon__like-label" for="like">★</label>
                <form class="like-form" action="/item/{{ $item->id }}/like" method="post">
                    @csrf
                    <input type="submit" value="いいね追加" id="like">
                </form>
                @else
                <p class="icon__like-label">★</p>
                @endif
                @else
                <label class="icon__not-like-label" for="not-like">★</label>
                <form class="not-like-form" action="/item/{{ $item->id }}/not-like" method="post">
                    @csrf
                    <input type="submit" value="いいね解除" id="not-like">
                </form>
                @endif
                <p class="icon__like-count">{{ $item_likes->count() }}</p>
            </div>
            <div class="icon">
                <div class="icon__comment-div"></div>
                <p class="icon__comment-count">{{ $item_comments->count() }}</p>
            </div>
        </div>

        <form class="purchase-form" action="/purchase/{{ $item->id }}" method="post">
            @csrf
            @if($item->purchase == null)
            <button class="purchase-form__button-submit">購入手続きへ</button>
            @else
            <button class="purchase-form__button-submit disabled" disabled>購入手続きへ</button>
            @endif
        </form>
        <div class="item__group">
            <h2 class="item__desc">商品説明</h2>
            <p class="item__desc-text">{{ $item->description }}</p>
        </div>
        <div class="item__group">
            <h2 class="item__info">商品の情報</h2>
            <div class="item__category-group">
                <p class="item__category-title">カテゴリー</p>
                <div class="item__categories">
                    @foreach ($item_categories as $category)
                    <p class="item__category-text">{{ $category->content }}</p>
                    @endforeach
                </div>
            </div>
            <div class="item__condition-group">
                <p class="item__condition-title">商品の状態</p>
                <p class="item__condition-text">{{ $item->condition->content }}</p>
            </div>
        </div>
        <div class="item__group">
            @if($item_comments->isEmpty())
            <h2 class="item__number-comments">コメントはまだありません</h2>
            @else
            <h2 class="item__number-comments">コメント({{ $item_comments->count() }})</h2>
            @endif
            @foreach ($item_comments as $comment)
            <div class="comment__user">
                <div class="comment__user-info">
                    <div class="comment__user-image">
                        @if($comment->image != null)
                        <img src="{{ asset($comment->image) }}" alt="プロフ画像">
                        @else
                        <div></div>
                        @endif
                    </div>
                    <p class="comment__user-name">{{ $comment->user->name }}</p>
                </div>
                <p class="comment__user-text">{{ $comment->content }}</p>
            </div>
            @endforeach
        </div>
        <form class="comment-form" action="/item/comment" method="post">
            @csrf
            <label class="comment-form__label" for="comment">商品へのコメント</label>
            <textarea class="comment-form__textarea" name="comment" id="comment"></textarea>
            @if(Auth::check())
            <button class="comment-form__button-submit">コメントを送信する</button>
            @else
            <button class="comment-form__button-submit disabled" disabled>コメントを送信する</button>
            @endif
        </form>
    </div>
</div>
@endsection