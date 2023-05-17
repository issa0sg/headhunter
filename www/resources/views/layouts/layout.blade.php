<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('assets/css/admin.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/main.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/create.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/section.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/user.css')}}">
    <title>Главная страница</title>
</head>
<body>

    <!-- @if (auth()->check())
        <a href="#">{{ auth()->user()->name }}</a>
        <br>
        <a href="{{route('logout')}}">Logout</a>
    @endif -->

    @if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    @endif

    @auth


    <header class="header">
        <div class="header-inner">
            <div class="header-user">
                <div>
                    <span class="header-user__info">user: <a href="{{route('user.index')}}" class="header-user__name">{{ auth()->user()->name }}</a></span>
                    <a href="{{route('logout')}}">Logout</a>
                </div>
                @if(session()->has('error'))
                <li class="header-user__status-error">
                    {{session('error')}}
                </li>
                @endif
                @if (session()->has('success'))
                <li class="header-user__status-succes">
                    {{session('success')}}
                </li>
                @endif
            </div>
            <div class="hot">
                <a href="#" class="hot-link">hot categories</a>
            </div>
            <div class="header-navbar">
                @if (auth()->user()->is_admin)
                @include('admin.layout')
                @endif
                <div class="orders">
                    <li><img src="../../../public/assets/img/arrowDown.png" class="arrow-down" />заказы</li>
                    <div id="order-links" class="links">
                        <a href="{{route('orders.index')}}">Список заказов</a>
                        <a href="{{route('orders.create')}}">Создать заказ</a>
                    </div>
                </div>
            </div>
        </div>
    </header>


    @endauth

    @yield('content')
</body>

</html>