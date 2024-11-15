<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Change Your Password</title>
</head>
<style>
    .my_input{
        width: 400px;
    }
    form{
        height: 240px;
    }
    .sign_in{
        width: 120px;
        height: 40px;
    }

    input{
        margin-bottom: 20px;
    }
    .alert{
        max-width: 20vw;
        display: block;
        position: absolute;
        top: 2%;
        right: 1%;
        opacity: 0;
        transition: opacity 300ms ease-in-out
    }
    .alert.show{
        opacity: 1;
    }
    .alert.hide{
        opacity: 0;
    }
</style>
<body>
    <div class="w-50 mx-auto mt-5">
        <h2 class="text-center mb-2">Hi {{ $name }}, you're changing your password</h2>
        <p class="login_text text-center mb-4">Enter your old-password and new-password to confirm</p>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul style="list-style-type: none;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="my_input mx-auto">
            <form action="{{ route('change_user_pass') }}" method="POST" class="form-control border-2 p-3">
                @csrf
                @method('PUT')
                <input type="password" name="password" class="form-control border-2" placeholder="Your Current Password" required>
                <input type="password" name="password_new" class="form-control border-2" placeholder="New Password" required>
                <div class="text-center mt-5">
                    <button type="submit" class="sign_in btn btn-success">Confirm</button>
                </div>
            </form>
            <div class="text-center mt-3">
                <a href="/user" class="register btn btn-outline-secondary">Cancel</a>
                <a href="{{ route('show_user_forgetpass') }}" class="forgot_pass btn btn-outline-secondary">Forgot password</a>
            </div>
        </div>
    </div>
    <script>
        let alert = document.getElementsByClassName('alert');
        if (alert.length > 0) {
            setInterval(() => {
                for(let i=0; i<alert.length; i++){
                    alert[i].classList.add('show');
                }
            }, 200);

            setInterval(() => {
                for(let i=0; i<alert.length; i++){
                    alert[i].classList.remove('show');
                    alert[i].classList.add('hide');
                }
            }, 3000);
        }
    </script>
</body>
</html>