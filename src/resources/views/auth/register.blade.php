<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COACHTECH</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
</head>

<body>
    <header class="header">
        <img class="header__img-logo" src="{{ asset('storage/images/logo.svg') }}" alt="coachtech">
    </header>

    <main>
        <div class="register-content">
            <h1 class="register-form__heading">会員登録</h1>
            <form class="register-form" action="/register" method="post">
                @csrf
                <div class="form__group">
                    <label class="form__label" for="name">ユーザー名</label>
                    <div class="form__group-content">
                        <div class="form__input-text">
                            <input type="text" name="name" id="name" value="{{ old('name') }}">
                        </div>
                        <div class="form__error">
                            @error('name')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form__group">
                    <label class="form__label" for="email">メールアドレス</label>
                    <div class="form__group-content">
                        <div class="form__input-text">
                            <input type="email" name="email" id="email" value="{{ old('email') }}">
                        </div>
                        <div class="form__error">
                            @error('email')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form__group">
                    <label class="form__label" for="password">パスワード</label>
                    <div class="form__group-content">
                        <div class="form__input-text">
                            <input type="password" name="password" id="password">
                        </div>
                        <div class="form__error">
                            @error('password')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form__group">
                    <label class="form__label" for="password_confirmation">確認用パスワード</label>
                    <div class="form__group-content">
                        <div class="form__input-text">
                            <input type="password" name="password_confirmation" id="password_confirmation">
                        </div>
                        <div class="form__error">
                            @error('password_confirmation')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <button class="form__button-submit" type="submit">登録する</button>
            </form>
            <a class="login__button-submit" href="/login">ログインはこちら</a>
        </div>
    </main>
</body>

</html>