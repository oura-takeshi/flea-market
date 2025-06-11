@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/sell.css') }}">
@endsection

@section('content')
<div class="content">
    <h1 class="item-form__heading">商品の出品</h1>
    <form class="item-form" action="">
        <div class="form__group"></div>
        <div class="form__group">
            <h2 class="form__title">商品の詳細</h2>
            <div class="form__body"></div>
        </div>
        <div class="form__group">
            <h2 class="form__title">商品名と説明</h2>
            <div class="form__body"></div>
        </div>
        <button class="form__button-submit" type="submit">出品する</button>
    </form>
</div>
@endsection