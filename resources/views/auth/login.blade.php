<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Avontur App</title>

        <script src="{{ asset('assets/js/app.js') }}" defer></script>

        <link href="{{ asset('assets/css/auth.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet" />
    </head>
    <body style="background-image:url({{ asset('assets/img/Avontur.png') }}) ;">
        <div class="d-flex justify-content-center">
            <div class="container-box">
                <form action="{{ route('auth.login') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="formGroupExampleInput" class="form-label"
                            >Username</label
                        >
                        <input
                            type="text"
                            class="form-control"
                            name="username"
                            placeholder="Username"
                            value="{{ old('username') }}"
                        />
                        <span class="text-danger"
                            >@error('username'){{ $message }}@enderror</span
                        >
                    </div>
                    <div class="mb-3">
                        <label for="formGroupExampleInput2" class="form-label"
                            >Password</label
                        >
                        <input
                            type="password"
                            class="form-control"
                            name="password"
                            placeholder="Password"
                            value="{{ old('password') }}"
                        />
                        <span class="text-danger"
                            >@error('password'){{ $message }}@enderror</span
                        >
                    </div>
                    @if(Session::get('fail'))
                    <div class="p-3 mb-2 bg-danger text-white">
                        {{ Session::get('fail') }}
                    </div>
                    @endif

                    <button
                        type="submit"
                        class="btn btn-block mb-3 text-white"
                        style="background-color: #bb823f"
                    >
                        Login
                    </button>
                </form>
            </div>
        </div>
    </body>
</html>
