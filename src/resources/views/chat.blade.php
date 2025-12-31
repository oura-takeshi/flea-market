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
    <div class="right-cintent">
        <section class="partner-section">
            <div class="partner-section__image"></div>
            <h1 class="partner-section__title">「ユーザー名」さんとの取引画面</h1>
        </section>
        <section class="item-section"></section>
        <section class="chat-section"></section>
    </div>
</div>
@endsection