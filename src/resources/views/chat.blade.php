@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/chat.css') }}">
@endsection

@section('content')
<div class="content">
    <div class="left-content">
        <h2 class="chat-links__header">その他の取引</h2>
        <div class="chat-links">
            <a class="chat-links__link" href="">商品名</a>
            <a class="chat-links__link" href="">商品名</a>
            <a class="chat-links__link" href="">商品名</a>
        </div>
    </div>
    <div class="right-content">
        <section class="partner-section">
            <div class="partner-section__header">
                <div class="partner-section__avatar">
                    <img src="{{ asset('storage/' . 'images/items/shoulder_bag.jpg') }}" alt="プロフ画像">
                </div>
                <h1 class="partner-section__title">「ユーザー名」さんとの取引画面</h1>
            </div>
            <a class="partner-section__complete-button" href="">取引を完了する</a>
        </section>
        <section class="item-section">
            <img class="item-section__image" src="{{ asset('storage/' . 'images/items/shoulder_bag.jpg') }}" alt="商品画像">
            <div class="item-section__info">
                <p class="item-section__name">ショルダーバッグ</p>
                <p class="item-section__price-yen">&yen
                    <span class="item-section__price-number">商品価格</span>
                </p>
            </div>
        </section>
        <section class="chat-section">
            <div class="chat-section__messages">
                <div class="chat-section__message chat-section__message--partner">
                    <div class="chat-section__author">
                        <div class="chat-section__author-avatar">
                            <img src="{{ asset('storage/' . 'images/items/shoulder_bag.jpg') }}" alt="プロフ画像">
                        </div>
                        <p class="chat-section__author-name">ユーザー名</p>
                    </div>
                    <div class="chat-section__content">
                        <p class="chat-section__text">【既読】発送が完了しました。到着までお待ち下さい。</p>
                        <img class="chat-section__image" src="{{ asset('storage/' . 'images/items/shoulder_bag.jpg') }}" alt="メッセージ画像">
                    </div>
                </div>
                <div class="chat-section__message chat-section__message--mine">
                    <div class="chat-section__author">
                        <p class="chat-section__author-name">ユーザー名</p>
                        <div class="chat-section__author-avatar">
                            <img src="{{ asset('storage/' . 'images/items/shoulder_bag.jpg') }}" alt="プロフ画像">
                        </div>
                    </div>
                    <div class="chat-section__actions">
                        <form class="chat-section__edit-form" action="">
                            <div class="chat-section__content chat-section__content-margin">
                                <textarea class="chat-section__edit-form-textarea chat-input" name="" id="">【既読】商品を受け取りました。ありがとうございます。</textarea>
                                <img class="chat-section__image" src="{{ asset('storage/' . 'images/items/shoulder_bag.jpg') }}" alt="メッセージ画像">
                            </div>
                            <button class="chat-section__edit-form-submit-button" type="submit">編集</button>
                        </form>
                        <form class="chat-section__delete-form" action="">
                            <button class="chat-section__delete-form-submit-button" type="submit">削除</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="chat-section__composer">
                <form class="chat-section__composer-form" action="">
                    <textarea class="chat-section__composer-form-textarea chat-input" name="" id="" placeholder="取引メッセージを記入して下さい" rows="1"></textarea>
                    <label class="chat-section__composer-form-label" for="message_image">画像を追加</label>
                    <input class="chat-section__composer-form-input-file" type="file" name="" id="message_image">
                    <button class="chat-section__composer-form-submit-button" type="submit">
                        <img class="chat-section__composer-form-button-img" src="{{ asset('images/ui/input_button.jpg') }}" alt="送信">
                    </button>
                </form>
            </div>
        </section>
    </div>
</div>
<script>
    document.addEventListener('input', function(e) {
        if (e.target.classList.contains('chat-input')) {
            e.target.style.height = 'auto';
            e.target.style.height = e.target.scrollHeight + 'px';
        }
    });
</script>
@endsection