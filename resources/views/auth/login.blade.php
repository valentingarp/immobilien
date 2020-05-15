<!DOCTYPE html>
<!--
* CoreUI - Free Bootstrap Admin Template
* @version v2.1.7
* @link https://coreui.io
* Copyright (c) 2018 creativeLabs Łukasz Holeczek
* Licensed under MIT (https://coreui.io/license)
-->

<html lang="en">
  <head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
   <title>IMMOBILIEN</title>
   <meta name="csrf-token" content="{{ csrf_token() }}">   
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Main styles for this application-->
    <link href="css/style.css" rel="stylesheet">
    <link href="{{asset('css/font-awesome.all.css')}}" rel="stylesheet">

  </head>
  <body class="app flex-row align-items-center" style="background: url('/img/fondo-image.jpg');background-repeat: no-repeat;background-size: 100%">
    <div id="app"></div>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-4">
          <div class="card-group">
            <div class="card p-4" style="border: solid 1px #E9F1FF;background: transparent;">
              <div class="card-body">
              <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                        
                        {{ csrf_field() }}
                <h1 style="text-align: center;">
                  <img src="{{asset('img/logoimm.png')}}" alt="" class="img-fluid" width="180">
                </h1>
                <p class="text-muted" style="margin-bottom: 1px"><i class="fas fa-sign-in-alt"></i> Acceso</p>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="fas fa-user"></i>
                    </span>
                  </div>
                  <input id="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus placeholder="Usuario">
                  @if ($errors->has('email'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('email') }}</strong>
                      </span>
                  @endif
                </div>
                <div class="input-group mb-4">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="fas fa-lock"></i>
                    </span>
                  </div>
                  <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="Contraseña">
                  @if ($errors->has('password'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('password') }}</strong>
                      </span>
                  @endif
                </div>
                <div class="row">
                  <div class="col-12">
                     <button type="submit" class="btn btn-primary btn-block">
                                    {{ __('INGRESAR') }}
                                </button>
                  </div>
                </div>
                
              </form>
              </div>
            </div>
          </div>
          <p style="text-align: center;font-size: 9pt;color: #8E8E8E">&copy; Copyright 2020 Immobilien | Todos los derechos reservados.</p>
        </div>
      </div>
    </div>
    <!-- CoreUI and necessary plugins-->
    <script src="{{asset('js/app.js')}}"></script>
    
  </body>
</html>
