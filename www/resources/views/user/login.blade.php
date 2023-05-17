<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../../public/assets/css/authorization.css">
    <title>Login</title>
</head>

<body>

    <div class="error">
        @if ($errors->any())
        <ul class="error">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        @endif

        @if(session()->has('error'))
        <li class="error">
            {{session('error')}}
        </li>
        @endif
    </div>

    <div class="wrapper">
        <img src="../../../public/assets/img/formBackground.jpg" alt="background" class="background-image">



        <div class="block">
            <h1 class="block-title">
                Sign in
            </h1>
            <form action="{{ route('login') }}" method="post" class="block-form">

                @csrf
                <div class="block-form__fields">
                    <div> <label for="email" class="authorization-form__des">Your email</label>
                        <input type="email" name="email" class="authorization-form__input" placeholder="email">
                    </div>
                    <div>
                        <label for="password" class="authorization-form__des">Your password</label>
                        <input type="password" name="password" class="authorization-form__input" placeholder="password">
                    </div>
                </div>
                <button type="submit" class="block-form__button">Login</button>
            </form>
            <a href="{{route('register.create')}}" class="block-link">Registry</a>
        </div>
    </div>
</body>

</html>