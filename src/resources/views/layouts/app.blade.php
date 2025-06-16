<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COACHTECH</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('css')
</head>

<body>
    <header class="header">
        <img class="header__img-logo" src="{{ asset('storage/images/logo.svg') }}" alt="coachtech">
        <form action="/" class="search-form" method="post">
            @csrf
            @isset($keyword)
            <input type="text" class="search-form__keyword-input" type="text" name="keyword" value="{{ $keyword }}">
            @else
            <input type="text" class="search-form__keyword-input" type="text" name="keyword" placeholder="なにをお探しですか？">
            @endisset
        </form>
        <nav class="nav">
            @if (Auth::check())
            <form action="/logout" class="nav__logout" method="post">
                @csrf
                <button class="nav__logout-button">ログアウト</button>
            </form>
            @else
            <a href="/login" class="nav__login-link">ログイン</a>
            @endif
            <a href="/mypage?page=sell" class="nav__mypage-link">マイページ</a>
            <a href="/sell" class="nav__sell-link">出品</a>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>
</body>

</html>