<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{asset('assets/img/basic/favicon.ico')}}" type="image/x-icon">
    <title>IT CORNER EXAM SYSTEM</title>
    <!-- CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('assets/css/app.css')}}">
    <style>
        .plane-container {
            position: absolute;
            top: 50%;
            left: 50%;
        }
    </style>
    </body>
</head>

<body class="light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div style="background-color: #2979ff!important;" class="card-header text-center text-white">
                        <h1>IT CORNER EXAM SYSTEM</h1>
                        <h4>Admin Login</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('login')  }}">
                            @csrf
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                    @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                    @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>
                                    @if (Route::has('password.request'))

                                    @endif
                                </div>
                                <div class="col-md-8 offset-md-12">
                                    <p id="text">Not a Member ? <a href="{{ route('register') }}" id="signup">Signup Now</a></p>
                                </div>
                            </div>
                        </form>
                    </div>
                    @if(session()->has('success'))
                    <div id="success" class="card-footer text-center">
                        <div class="alert alert-success">
                            {{session()->get('success')}}
                        </div>
                    </div>
                    @endif
                    @if(session()->has('failed'))
                    <div id="failed" class="card-footer text-center">
                        <div class="alert alert-danger">
                            {{session()->get('failed')}}
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $("#success").show().delay(5000).fadeOut();
        $("#failed").show().delay(5000).fadeOut();
    </script>
</body>

</html>