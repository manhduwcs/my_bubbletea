<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Log In</title>
</head>
<body>
    @foreach ($errors as $error)
        <h3>{{ $error }}</h3>
    @endforeach

    <h3>This is the Login Page</h3>
</body>
</html>