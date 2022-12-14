<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap core CSS -->
    <link href="{{ asset('imports/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('imports/login.css') }}" rel="stylesheet" />
    <title>Login</title>
</head>

<body>
    <div class="conatiner-fluid">
        <div class="Auth-form-container">
            <form class="Auth-form" action="{{ route('auth.check') }}" method="POST">
                @csrf
                <div class="Auth-form-content">
                    <h3 class="Auth-form-title">Sign In</h3>
                    <div class="form-group mt-3">
                        <label>Email address</label>
                        <input type="email" name="email" class="form-control mt-1" placeholder="Enter email"
                            value="{{ old('email') }}" />
                        <span class="text-danger">
                            @error('email')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="form-group mt-3">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control mt-1" placeholder="Enter password" />
                        <span class="text-danger">
                            @error('password')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="d-grid gap-2 mt-3">
                        <button type="submit" class="btn btn-primary">
                            Login
                        </button>
                    </div>

                </div>
                @if (Session::get('fail'))
                    <div class="alert alert-danger">
                        {{ Session::get('fail') }}
                    </div>
                @endif
            </form>
        </div>

    </div>

</body>

</html>
