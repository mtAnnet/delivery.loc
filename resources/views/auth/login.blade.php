<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <title>Вход</title>
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
        <div class="title">{{ __('Войти') }}</div>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="input">
                <label for="email">{{ __('Email') }}</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <span class="spin"></span>
            </div>
            <div class="input">
                <label for="password">{{ __('Пароль') }}</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <span class="spin"></span>
            </div>
            <div class="input-remember">
                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label for="remember">{{ __('Запомнить меня') }}</label>
            </div>
            <div class="input-remember">
                <span class="form-tag">Еще нет аккаунта?</span>
                <a class="form-link" href="{{ route('register') }}">{{ __('Зарегистрироваться') }}</a>
            </div>
            <div class="button login">
                <button type="submit"><i class="fa fa-check"></i>{{ __('Войти') }}</button>
            </div>
            @if (Route::has('password.request'))
                <a class="pass-forgot" href="{{ route('password.request') }}">
                    {{ __('Забыли пароль?') }}
                </a>
            @endif

        </form>
    </div>
</div>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="/js/auth.js"></script>
</body>
</html>

