<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="">
    <title>Premire Legue Table</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body>

{{-- top header --}}
<nav class="navbar navbar-expand-sm navbar-dark">
    <!-- Brand/logo -->
    <a class="navbar-brand" href="#">
        <img src="{{asset('images/premier-league-logo-header.svg')}}">
    </a>

    <!-- Links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="{{route('home')}}">Premiere Ligue</a>
        </li>
    </ul>
</nav>
<ul class="breadcrumb">
    <div class="container">
        <li><a href="#">Home</a></li>
    </div>
</ul>

<div class="container-fluid">
    @yield('content')
</div>

<script src="{{asset('js/app.js')}}"></script>
</body>
</html>