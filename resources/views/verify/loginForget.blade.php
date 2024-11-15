<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Forgetpass Confirmation</title>
</head>
<style>
    .my_input{
        width: 400px;
    }
    form{
        height: 140px;
    }
    .btn{
        width: 120px;
        height: 40px;
    }
    .alert{
        width: 400px;
    }
    input{
        margin-bottom: 20px;
    }
</style>
<body>
    <div class="w-50 mx-auto mt-5">
        <h2 class="text-center mb-2">Dear user {{ $name }}, one more step to reset your password</h2>
        <p class="login_text text-center mb-4">Please enter the 6-digit code we sent to your email address.</p>
        <p class="login_text text-center text-danger mb-4">Please note that the code will expire in 3 minutes.</p>
        @if ($errors->any())
            <div class="alert alert-danger mx-auto">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="my_input mx-auto">
            <form action="{{ route('show_loginforget_newpass') }}" method="POST" class="form-control border-2 p-3">
                @csrf
                <input type="number" name="input_code" class="form-control border-2" placeholder="Enter your code here" required>
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-success">Confirm</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>