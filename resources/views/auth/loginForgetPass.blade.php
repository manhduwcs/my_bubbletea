<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Forgot password ?</title>
</head>
<style>
    .my_input{
        width: 400px;
    }
    form{
        height: 220px;
    }
    .sign_in{
        width: 120px;
        height: 40px;
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
    input{
        margin-bottom: 20px;
    }
</style>
<body>
    <div class="w-50 mx-auto mt-5">
        <h2 class="text-center mb-2">Dear user, you forgot your password ? No problem !</h2>
        <p class="login_text text-center mb-4">Please enter your current email address and your phone number.<br> We will send to your email-address a 6-digit code to reset your password.</p>
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
            <form action="{{ route('send_loginforget_mail') }}" method="POST" class="form-control border-2 p-3">
                @csrf
                <input type="email" name="email" class="form-control border-2" placeholder="Your current Email" required>
                <input type="number" name="phone" class="form-control border-2" placeholder="Your current Phone Number" required>
                <div class="text-center mt-5">
                    <button type="submit" class="sign_in btn btn-success">Send Mail</button>
                </div>
            </form>
            <div class="text-center mt-3">
                <a href="/login" class="register btn btn-outline-secondary">Cancel</a>
                <a href="/register" class="forgot_pass btn btn-outline-secondary">Don't have an account ?</a>
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