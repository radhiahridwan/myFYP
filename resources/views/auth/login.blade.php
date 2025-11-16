<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Siswi Management System - Login</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #1d357d, #294db0);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background: #fff;
            border-radius: 12px;
            padding: 30px;
            width: 350px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        h1 {
            color: #294db0;
            margin-bottom: 20px;
        }

        .tabs {
            display: flex;
            margin-bottom: 20px;
            border-radius: 8px;
            overflow: hidden;
            border: 1px solid #ccc;
        }

        .tabs a {
            flex: 1;
            padding: 10px;
            text-decoration: none;
            font-weight: bold;
            color: #294db0;
            background: #f5f5f5;
            transition: 0.3s;
        }

        .tabs a.active {
            background: #294db0;
            color: #fff;
        }

        .form-group {
            margin-bottom: 15px;
            text-align: left;
            position: relative;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        .toggle-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            user-select: none;
            width: 20px;
            height: 20px;
        }

        button {
            width: 100%;
            padding: 12px;
            background: #294db0;
            border: none;
            border-radius: 6px;
            color: white;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background: #1d357d;
        }

        .register-link {
            margin-top: 15px;
            font-size: 14px;
            color: #666;
        }

        .register-link a {
            color: #294db0;
            font-weight: bold;
            text-decoration: none;
        }

        .register-link a:hover {
            text-decoration: underline;
        }

        .alert {
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 15px;
            font-size: 14px;
            transition: opacity 0.5s ease;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .error-message {
            color: #dc3545;
            font-size: 13px;
            margin-top: 5px;
        }
    </style>
</head>

<body>

    <div class="container">
        <h1>Siswi Management System</h1>

        <div class="tabs">
            <a href="{{ url('/login') }}" class="active">Login</a>
            <a href="{{ url('/signup') }}">User Registration</a>
        </div>



        <form action="{{ url('/login') }}" method="POST">
            @csrf
            <div class="form-group">
                <input type="email" name="email" placeholder="Email Address" required value="{{ old('email') }}">
                @error('email')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <input type="password" name="password" id="password" placeholder="Password" required>
                <img src="{{ asset('images/eye-close.png') }}" id="togglePassword" class="toggle-password"
                    alt="Toggle Password">
                @error('password')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <!-- Auto-disappearing Messages -->
            @if (session('success'))
                <div class="alert alert-success" id="autoMessage">{{ session('success') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert alert-error" id="autoMessage">
                    @foreach ($errors->all() as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @endif
            <button type="submit">Login</button>
        </form>

        <div class="register-link">
            <p>New user? <a href="{{ url('/signup') }}">Register here</a></p>
        </div>
    </div>

    <script>
        // Password toggle functionality
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');

        togglePassword.addEventListener('click', function() {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            // Switch between eye-open and eye-closed images
            if (type === 'text') {
                this.src = '{{ asset('images/eye-open.png') }}'; // Password is visible
            } else {
                this.src = '{{ asset('images/eye-close.png') }}'; // Password is hidden
            }
        });

        // Auto-disappear ALL messages after 20 seconds with fade effect
        document.addEventListener('DOMContentLoaded', function() {
            const messages = document.querySelectorAll('#autoMessage');
            messages.forEach(message => {
                setTimeout(() => {
                    message.style.transition = 'opacity 0.5s ease';
                    message.style.opacity = '0';
                    setTimeout(() => message.remove(), 500);
                }, 20000); // 20 seconds
            });
        });
    </script>
</body>

</html>
