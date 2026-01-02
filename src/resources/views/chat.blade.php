@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/chat.css') }}">
@endsection

@section('content')
<div class="content">
    <div class="left-content">
        <h2 class="chat-links__header">その他の取引</h2>
        <div class="chat-links">
            @foreach ($other_chats as $other_chat)
            <a class="chat-links__link" href="/chat/{{ $other_chat->id }}">{{ $other_chat->purchase->item->name }}</a>
            @endforeach
        </div>
    </div>
    <div class="right-content">
        <section class="partner-section">
            <div class="partner-section__header">
                <div class="partner-section__avatar">
                    @if ($partner->profile->image)
                    <img src="{{ asset('storage/' . $partner->profile->image) }}" alt="プロフ画像">
                    @else
                    <div></div>
                    @endif
                </div>
                <h1 class="partner-section__title">{{ $partner->name }}さんとの取引画面</h1>
            </div>
            @if ($is_buyer)
            <a class="partner-section__complete-button" href="">取引を完了する</a>
            @endif
        </section>
        <section class="item-section">
            <img class="item-section__image" src="{{ asset('storage/' . $chat->purchase->item->image) }}" alt="商品画像">
            <div class="item-section__info">
                <p class="item-section__name">{{ $chat->purchase->item->name }}</p>
                <p class="item-section__price-yen">&yen
                    <span class="item-section__price-number">{{ number_format($chat->purchase->item->price) }}</span>
                </p>
            </div>
        </section>
        <section class="chat-section">
            <div class="chat-section__messages">
                @foreach ($chat_messages as $message)
                @if ($message->user_id !== Auth::id())
                <div class="chat-section__message chat-section__message--partner">
                    <div class="chat-section__author">
                        <div class="chat-section__author-avatar">
                            @if ($message->user->profile->image)
                            <img src="{{ asset('storage/' . $message->user->profile->image) }}" alt="プロフ画像">
                            @else
                            <div></div>
                            @endif
                        </div>
                        <p class="chat-section__author-name">{{ $message->user->name }}</p>
                    </div>
                    <div class="chat-section__content">
                        <p class="chat-section__text">{{ $message->content }}</p>
                        @if ($message->image)
                        <img class="chat-section__image" src="{{ asset('storage/' . $message->image) }}" alt="メッセージ画像">
                        @endif
                    </div>
                </div>
                @else
                <div class="chat-section__message chat-section__message--mine">
                    <div class="chat-section__author">
                        <p class="chat-section__author-name">{{ $message->user->name }}</p>
                        <div class="chat-section__author-avatar">
                            @if ($message->user->profile->image)
                            <img src="{{ asset('storage/' . $message->user->profile->image) }}" alt="プロフ画像">
                            @else
                            <div></div>
                            @endif
                        </div>
                    </div>
                    <div class="chat-section__actions">
                        <form class="chat-section__edit-form" action="">
                            <div class="chat-section__content chat-section__content-margin">
                                <textarea class="chat-section__edit-form-textarea chat-input" name="content" id="">{{ old('content', $message->content) }}</textarea>
                                @if ($message->image)
                                <img class="chat-section__image" src="{{ asset('storage/' . $message->image) }}" alt="メッセージ画像">
                                @endif
                            </div>
                            <button class="chat-section__edit-form-submit-button" type="submit">編集</button>
                        </form>
                        <form class="chat-section__delete-form" action="">
                            <button class="chat-section__delete-form-submit-button" type="submit">削除</button>
                        </form>
                    </div>
                </div>
                @endif
                @endforeach
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