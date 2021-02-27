<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Delivery Admin Panel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <link href="/css/admin/sb-admin.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css"integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
    <link href="/css/admin/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="/css/admin/custom-style.css" rel="stylesheet" type="text/css">
    <script src="{{ asset('/js/app.js') }}" defer></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</head>
<body>
    <div id="wrapper">
        <nav class="navbar-fixed-top navbar-inverse" role="navigation">
            <div class="navbar-header">
                <a class="navbar-brand" href="{{route('admin.index')}}"><img src="/img/logo.svg" alt="logo"  class="img-svg"></a>
            </div>
            <ul class="nav navbar-right top-nav">
                <li class="nav-item">
                    <a class="text-white"><i class="fa fa-user"></i>{{ Auth::user()->name }}</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fa fa-fw fa-power-off"></i>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="{{route('admin.index')}}"><i class="fa fa-fw fa-cutlery"></i> Рестораны</a>
                    </li>
                    <li>
                        <a href="{{route('admin.dishes')}}"><i class="fa fa-fw fa-cutlery"></i> Блюда</a>
                    </li>
                    <li>
                        <a href="{{route('admin.users')}}"><i class="fa fa-fw fa-users"></i> Пользователи</a>
                    </li>
                    <li>
                        <a href="{{route('admin.tables')}}"><i class="fa fa-fw fa-table"></i> Таблицы</a>
                    </li>
                    <li>
                        <a href="{{route('admin.orders')}}"><i class="fa fa-fw fa-list-alt"></i> Заказы</a>
                    </li>
                </ul>
            </div>
        </nav>
        <div id="page-wrapper">
            <div class="container-fluid">
            @yield('content')
            </div>
        </div>
    </div>
</body>
</html>
