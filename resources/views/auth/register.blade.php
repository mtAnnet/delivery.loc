<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <title>Регистрация</title>
    <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
    <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900&subset=latin,latin-ext'>
    <link rel="stylesheet" href="css/auth.css">
</head>
<body>
<div class="materialContainer">
    <div class="box">
        <a  href="{{ url('/') }}">
            <img src="/img/logo.svg" alt="Logo" class="logo">
        </a>
        <div class="title">{{ __('Регистрация') }}</div>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="input">
                <label for="name">{{ __('Имя') }}</label>
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                <span class="spin"></span>
            </div>
            <div class="input">
                <label for="email">{{ __('Email') }}</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>
            <div class="input">
                <label for="password">{{ __('Пароль') }}</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <span class="spin"></span>
            </div>
            <div class="input">
                <label for="password-confirm">{{ __('Подтвердите пароль') }}</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                <span class="spin"></span>
            </div>
            <div class="input-remember">
                <span class="form-tag">Уже есть аккаунт?</span>
                <a class="form-link" href="{{ route('login') }}">{{ __('Войти') }}</a>
            </div>
            <div class="button login">
                <button type="submit"><span>{{ __('Зарегистрироваться') }}</span></button>
            </div>
        </form>
    </div>
</div>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="/js/auth.js"></script>
</body>
</html>
