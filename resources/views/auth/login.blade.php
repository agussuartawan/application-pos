<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ __('Login') }}</title>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  @if($errors->any())
  <div class="alert alert-danger" role="alert">
    Identitas tersebut tidak terdaftar!
  </div>
  @endif
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <div class="text-center">
        <img src="{{ asset('img/null-avatar.png') }}" class="rounded" alt="...">
      </div>
      <h1><b>POS</b>App</h1>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Selamat datang, silahkan login</p>
      <form action="{{ route('login') }}" method="post">
        @csrf
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Login</button>
      </form>  
    </div>
  </div>
</div>
<script src="{{ asset('js/adminlte.min.js') }}"></script>
</body>
</html>
