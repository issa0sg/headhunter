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
    <title>Register form</title>
</head>

<body>

    @if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    @endif

    <div class="wrapper">
        <img src="../../../public/assets/img/formBackground.jpg" alt="background" class="background-image">

        <div class="block register-block">
            <h1 class="block-title">
                Register
            </h1>
            <form action="{{ route('register.store') }}" method="post" class="block-form">

                @csrf
                <div class="block-form__fields">
                    <div><label for="name">Your name</label>
                        <input type="text" name="name" value="{{old('name')}}" placeholder="name">
                    </div>
                    <div><label for="email">Your email</label>
                        <input type="email" name="email" value="{{old('email')}}" placeholder="email">
                    </div>
                    <div><label for="password">Your password</label>
                        <input type="password" name="password" placeholder="password">
                    </div>
                    <div><label for="password_confirmation">Retype password</label>
                        <input type="password" name="password_confirmation" placeholder="retype password">
                    </div>
                </div>

                <button type="submit" class="block-form__button">Register</button>
            </form>
            <a href="{{route('login.create')}}" class="block-link">I already have a membership</a>
        </div>
    </div>
</body>

</html>