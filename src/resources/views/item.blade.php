@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/item.css') }}">
@endsection

@section('content')
<div class="content">
    <div class="left-content">
        <img src="{{ asset('storage/' . $item->image) }}" alt="商品画像" class="item__img">
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
                <a class="icon__like-link" href="/item/{{ $item->id }}/like">★</a>
                @else
                <a class="icon__like-link" href="/register">★</a>
                @endif
                @else
                <a class="icon__not-like-link" href="/item/{{ $item->id }}/not-like">★</a>
                @endif
                <p class="icon__like-count">{{ $item_likes->count() }}</p>
            </div>
            <div class="icon">
                <div class="icon__comment-div"></div>
                <p class="icon__comment-count">{{ $item_comments->count() }}</p>
            </div>
        </div>
        @if($item->purchase == null)
        <a class="purchase-link" href="/purchase/{{ $item->id }}">購入手続きへ</a>
        @else
        <p class="purchase-p">購入手続きへ</p>
        @endif
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
                        <img src="{{ asset('storage/' . $comment->image) }}" alt="プロフ画像">
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
            <input type="hidden" name="item_id" value="{{ $item->id }}">
            <label class="comment-form__label" for="comment">商品へのコメント</label>
            <div class="comment-form__input-textarea">
                <textarea class="comment-form__textarea" name="comment" id="comment">{{ old('comment') }}</textarea>
                <div class="comment-form__error">
                    @error('comment')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <button class="comment-form__button-submit" type="submit">コメントを送信する</button>
        </form>
    </div>
</div>
@endsection