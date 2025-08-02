<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | BGB Diplomatic</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('assets/img/logo.png') }}" type="image/x-icon">
    <style>
        body {
            background: #A91D2A;
        }

        .login-box {
            max-width: 420px;
            margin: 5% auto;
            padding: 2.5rem;
            background: #ffffff;
            border-radius: 1rem;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .login-box h2 {
            font-weight: 600;
            margin-bottom: 1.5rem;
            color: #A91D2A;
        }

        .form-label {
            color: #333;
        }

        a {
            color: #A91D2A;
        }

        a:hover {
            color: #88111D;
        }
    </style>

</head>

<body>
    <div class="container">
        <div class="login-box">
            <h2 class="text-center">Sign in to BGB Diplomatic</h2>
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="mb-3">
                    <label for="username" class="form-label">User Name</label>
                    <input type="username" class="form-control @error('username') is-invalid @enderror" id="username"
                        name="username" required autofocus>
                    @error('username')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                        name="password" required>
                    @error('password')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Forgot password -->
                <div class="mb-3 d-flex justify-content-between">
                    <div>
                        <input class="form-check-input" type="checkbox" name="remember" id="remember">
                        <label class="form-check-label" for="remember">Remember me</label>
                    </div>
                </div>

                <!-- Submit -->
                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-primary">Sign In</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
