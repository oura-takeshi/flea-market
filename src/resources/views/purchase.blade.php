@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase.css') }}">
@endsection

@section('content')
<div class="content">
    <form class="purchase-form" action="/purchase" method="post">
        @csrf
        <div class="left-content">
            <div class="left-group">
                <div class="item__img">
                    <img src="{{ asset($item->image) }}" alt="商品画像">
                </div>
                <div class="item__content">
                    <div class="item__name">{{ $item->name }}</div>
                    <div class="item__price">&yen;&nbsp;<span class="item__price-span">{{ number_format($item->price) }}</span></div>
                </div>
            </div>
            <div class="left-group">
                <label class="payment-method__label" for="payment-method">支払い方法</label>
                <select class="payment-method__select" name="payment-method" id="payment-method" onchange="updateText(this)">
                    <option value="" selected disabled hidden>選択してください</option>
                    <option value="1">コンビニ払い</option>
                    <option value="2">カード支払い</option>
                </select>
            </div>
            <div class="left-group">
                <div class="address__head">
                    <div class="address__title">配送先</div>
                    <a class="address__purchass-address-link" href="/purchase/address/{{ $item->id }}">変更する</a>
                </div>
                @if($user->profile != null)
                <div class="address__body">
                    <p class="address__body-p">〒&nbsp;{{ $post_code }}</p>
                    <p class="address__body-p">{{ $address }}</p>
                    <p class="address__body-p">{{ $building }}</p>
                </div>
                @endif
            </div>
        </div>
        <div class="right-content">
            <div class="confirm-table">
                <table class="confirm-table__inner">
                    <tr class="confirm-table__row">
                        <th class="confirm-table__header">商品代金</th>
                        <td class="confirm-table__text">&yen;&nbsp;<span class="confirm-table__text-span">{{ number_format($item->price) }}</span></td>
                    </tr>
                    <tr class="confirm-table__row">
                        <th class="confirm-table__header">支払い方法</th>
                        <td class="confirm-table__text" id="selectedText"></td>
                    </tr>
                </table>
            </div>
            <input type="hidden" name="item_id" value="{{ $item->id }}">
            <input type="hidden" name="post_code" value="{{ $post_code }}">
            <input type="hidden" name="address" value="{{ $address }}">
            <input type="hidden" name="building" value="{{ $building }}">
            <button class="purchase-form__button-submit">購入する</button>
        </div>
    </form>
</div>
<script>
    function updateText(selectElement) {
        var selectedOption = selectElement.options[selectElement.selectedIndex];
        document.getElementById("selectedText").textContent = selectedOption.text;
    }
</script>
@endsection