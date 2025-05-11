@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage_profile.css') }}">
@endsection

@section('content')
<div class="profile-content">
    <h1 class="profile-form__heading">プロフィール設定</h1>
    <form action="" class="profile-form"></form>
</div>
@endsection