<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Wallet Stack Test - Register</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" type="text/css" >
</head>
<body class="register-color">
@if($errors->any())
    <div class="alert alert-danger" role="alert">
        Error Message: {{$errors->first()}}
    </div>
@endif
<div class="set-box-position-middle">
    <form method="post" action="{{route("register.create")}}">
        @csrf
        <h4 class="text-center mb-4">Register New Member</h4>
        <div class="form-group">
            <label for="inputFullName">Full Name</label>
            <input type="text" class="form-control" name="full_name" value="{{old("full_name")}}" id="inputFullName" placeholder="Enter Full Name">
        </div>
        <div class="form-group">
            <label for="inputEmailAddress">Email Address</label>
            <input type="email" class="form-control" id="inputEmailAddress" name="email" value="{{old("email")}}" placeholder="Enter Email Address">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Password">
        </div>
        <button type="submit" class="btn btn-primary btn-block">Sign Up</button>
        <div class="text-center mt-3">
            Have already an account? <a class="" href="{{route("login.show")}}">Login here</a>
        </div>
    </form>
</div>
</body>
</html>
