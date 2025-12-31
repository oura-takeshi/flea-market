@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/chat.css') }}">
@endsection

@section('content')
<div class="content">
    <div class="left-content">
        <h2 class="chat-links__header">その他の取引</h2>
        <div class="chat-links">
            <a class="chat-links__link" href="">商品名1</a>
            <a class="chat-links__link" href="">商品名2</a>
            <a class="chat-links__link" href="">商品名3</a>
        </div>
    </div>
    <div class="right-content">
        <section class="partner-section">
            <div class="partner-section__image">
                <img src="" alt="プロフ画像">
            </div>
            <h1 class="partner-section__title">「ユーザー名」さんとの取引画面</h1>
        </section>
        <section class="item-section">
            <div class="item-section__image">
                <img src="" alt="商品画像">
            </div>
            <div class="item-section__info">
                <p class="item-section__name">商品名</p>
                <p class="item-section__price">商品価格</p>
            </div>
        </section>
        <section class="chat-section">
            <div class="chat-section__messages">
                <div class="chat-section__message chat-section__message--mine">
                    <div class="chat-section__author">
                        <div class="chat-section__author-image">
                            <img src="" alt="プロフ画像">
                        </div>
                        <p class="chat-section__user-name">ユーザー名</p>
                    </div>
                    <div class="chat-section__actions">
                        <form class="chat-section__edit-form" action="">
                            <textarea class="chat-section__edit-form-textarea" name="" id=""></textarea>
                            <img class="chat-section__message-image" src="" alt="メッセージ画像">
                            <button class="chat-section__edit-form-submit-button" type="submit">編集</button>
                        </form>
                        <form class="chat-section__delete-form" action="">
                            <button class="chat-section__delete-form-submit-button" type="submit">削除</button>
                        </form>
                    </div>
                </div>
                <div class="chat-section__message chat-section__message--partner">
                    <div class="chat-section__author">
                        <div class="chat-section__author-image">
                            <img src="" alt="プロフ画像">
                        </div>
                        <p class="chat-section__user-name">ユーザー名</p>
                    </div>
                    <p class="chat-section__content"></p>
                    <img class="chat-section__message-image" src="" alt="メッセージ画像">
                </div>
            </div>
            <div class="chat-section__composer">
                <form class="chat-section__composer-form" action="">
                    <textarea class="chat-section__input-form-textarea" name="" id=""></textarea>
                    <label class="chat-section__input-form-label" for="message_image">画像を追加</label>
                    <input type="file" name="" id="message_image">
                    <button class="chat-section__input-form-submit-button" type="submit">
                        <img class="chat-section__input-form-button-img" src="{{ asset('images/ui/input_button.jpg') }}" alt="送信">
                    </button>
                </form>
            </div>
        </section>
    </div>
</div>
@endsection