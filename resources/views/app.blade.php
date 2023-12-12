<?php
$currentUrl = Request::path();
?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Wallet Stack Test - Register</title>

    <!-- Fonts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" type="text/css" >
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/">Wallet Stack Test</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item {{ ($currentUrl == 'transactions') ? 'active':'' }}">
                <a class="nav-link" href="{{route("transaction.show")}}">Transaksi</a>
            </li>
            <li class="nav-item {{ ($currentUrl == 'balance-histories') ? 'active':'' }}">
                <a class="nav-link" href="{{route("balancehistory.index")}}">Riwayat Saldo</a>
            </li>
        </ul>
        <div>
            <a class="nav-link text-dark" href="{{route('logout')}}">Logout</a>
{{--            Current Balance <br>--}}
{{--            <small class="text-success">Rp. 1000.000</small>--}}
        </div>
    </div>
</nav>
@if($errors->any())
    <div class="alert alert-danger" role="alert">
        Error Message: {{$errors->first()}}
    </div>
@endif
@if(session()->get('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
@endif
@yield('content')
@yield('local_script')
</body>
</html>
