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
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
        }

        .container-box {
            display: flex;
            align-items: center;
            gap: 50%;
            width: 55%;
        }

        .logo-box img {
            max-width: 200px;
        }

        .login-card {
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
            padding: 2.5rem;
            width: 100%;
            max-width: 400px;
            color: #333;
        }

        .login-header {
            background-color: #A91D2A;
            color: white;
            text-align: center;
            padding: 1rem;
            border-radius: 10px 10px 0 0;
            margin: -2.5rem -2.5rem 2rem -2.5rem;
            font-weight: 600;
            font-size: 1.2rem;
        }

        .btn-login {
            background-color: #A91D2A;
            color: #fff;
            font-weight: bold;
            border-radius: 5px;
            transition: background 0.3s;
        }

        .btn-login:hover {
            background-color: #88111D;
        }

        a {
            color: #A91D2A;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
            color: #88111D;
        }
    </style>
</head>

<body>
    <div class="container-box">
        <!-- Left Logo -->
        <div class="logo-box">
            <img src="{{ asset('assets/img/cover_logo.png') }}" alt="Logo">
        </div>

        <!-- Right Login Box -->
        <div class="login-card">
            <div class="login-header">BGB Diplomatic</div>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <!-- Username -->
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control @error('username') is-invalid @enderror" id="username"
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
                <!-- Remember Me -->
                <div class="mb-3 form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                    <label class="form-check-label" for="remember">Remember Me</label>
                </div>
                <!-- Submit -->
                <div class="d-grid mb-2">
                    <button type="submit" class="btn btn-login">Login</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
