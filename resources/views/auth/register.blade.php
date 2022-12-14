<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('imports/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('imports/login.css') }}" rel="stylesheet" />
    <title>Register</title>
</head>

<body>
    <div class="conatiner">
        <div class="Auth-form-container">
            <form class="Auth-form" action="{{ route('auth.save') }}" method="POST">
                @csrf
                <div class="Auth-form-content">
                    <h3 class="Auth-form-title">Sign Up</h3>
                    <div class="form-group mt-3">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control mt-1" placeholder="Your Name"
                            value="{{ old('name') }}" />
                        <span class="text-danger"> @error('name')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="form-group mt-3">
                        <label>Email address</label>
                        <input type="email" name="email" class="form-control mt-1" placeholder="Enter email"
                            value="{{ old('email') }}" />
                        <span class="text-danger"> @error('email')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="form-group mt-3">
                        <label>Role</label>
                        <select class="form-select" name="role" class="form-control mt-1" placeholder="User Role">
                            <option value="User">User</option>
                            <option value="HON">Head of Unit</option>
                            <option value="TPM">TPM</option>
                            <option value="CSTO">CSTO</option>
                        </select>                        
                        <span class="text-danger"> @error('role')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>                    
                    <div class="d-grid gap-2 mt-3">
                        <button type="submit" class="btn btn-primary">
                            Sing Up
                        </button>
                    </div>                   
                    @if (Session::get('Success'))
                        <div class="alert alert-success">
                            {{ Session::get('Success') }}
                        </div>
                    @endif
                    @if (Session::get('fail'))
                        <div class="alert alert-danger">
                            {{ Session::get('Failed') }}
                        </div>
                    @endif

                </div>
            </form>
        </div>
    </div>

</body>

</html>
