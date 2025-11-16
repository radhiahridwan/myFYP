<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Siswi Management System - User Registration</title>
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

        .alert {
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 15px;
            font-size: 14px;
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

        .password-info {
            background: #e7f3ff;
            color: #004085;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 15px;
            font-size: 13px;
            border: 1px solid #b3d7ff;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Siswi Management System</h1>

        <div class="tabs">
            <a href="{{ url('/login') }}">Login</a>
            <a href="{{ url('/signup') }}" class="active">User Registration</a>
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

        <!-- Password Information -->
        <div class="password-info">
            <strong>Default Password:</strong>
            <br>
            • Student: siswiuptm<br>
        </div>

        <form action="{{ route('signup.submit') }}" method="POST" id="signupForm">
            @csrf

            <!-- Full Name -->
            <div class="form-group">
                <input type="text" name="name" placeholder="Full Name" required value="{{ old('name') }}">
                @error('name')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <!-- Student ID -->
            <div class="form-group student-field">
                <input type="text" name="student_id" placeholder="Student ID (e.g., KL12345)"
                    value="{{ old('student_id') }}">
                @error('student_id')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <!-- Hostel Room -->
            <div class="form-group student-field">
                <input type="text" name="hostel_room" placeholder="Hostel Room (Optional)"
                    value="{{ old('hostel_room') }}">
                @error('hostel_room')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <!-- Course -->
            <div class="form-group student-field">
                <input type="text" name="course" placeholder="Course" value="{{ old('course') }}">
                @error('course')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email -->
            <div class="form-group">
                <input type="email" name="email" id="email" placeholder="Email Address" required
                    value="{{ old('email') }}">
                @error('email')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <!-- Phone Number -->
            <div class="form-group">
                <input type="text" name="phone_number" placeholder="Phone Number" value="{{ old('phone_number') }}">
                @error('phone_number')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <!-- Address -->
            <div class="form-group student-field">
                <input type="text" name="address" placeholder="Address" value="{{ old('address') }}">
                @error('address')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="form-group">
                <input type="password" name="password" id="password" placeholder="Password" required>
                <img src="{{ asset('images/eye-close.png') }}" id="togglePassword" class="toggle-password"
                    alt="Toggle Password">
                @error('password')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="form-group">
                <input type="password" name="password_confirmation" placeholder="Confirm Password" id="confirmPassword"
                    required>
                <img src="{{ asset('images/eye-close.png') }}" id="toggleConfirmPassword" class="toggle-password"
                    alt="Toggle Confirm Password">
            </div>
            <button type="submit">Sign Up</button>
        </form>
    </div>

    <script>
        // Password toggle functionality
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');
        const toggleConfirmPassword = document.querySelector('#toggleConfirmPassword');
        const confirmPassword = document.querySelector('#confirmPassword');

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

        toggleConfirmPassword.addEventListener('click', function() {
            const type = confirmPassword.getAttribute('type') === 'password' ? 'text' : 'password';
            confirmPassword.setAttribute('type', type);
            // Switch between eye-open and eye-closed images
            if (type === 'text') {
                this.src = '{{ asset('images/eye-open.png') }}'; // Password is visible
            } else {
                this.src = '{{ asset('images/eye-close.png') }}'; // Password is hidden
            }
        });

        // Role detection based on email domain
        const emailInput = document.querySelector('#email');
        const studentFields = document.querySelectorAll('.student-field');

        emailInput.addEventListener('input', function() {
            const email = emailInput.value;
            const isStudent = /^kl\d+@student\.uptm\.edu\.my$/i.test(email);

            studentFields.forEach(field => {
                field.style.display = isStudent ? 'block' : 'none';
            });
        });

        // Auto-disappear messages after 20 seconds
        document.addEventListener('DOMContentLoaded', function() {
            // Auto-hide messages
            const messages = document.querySelectorAll('#autoMessage');
            messages.forEach(message => {
                setTimeout(() => {
                    message.style.transition = 'opacity 0.5s ease';
                    message.style.opacity = '0';
                    setTimeout(() => message.remove(), 500);
                }, 20000); // 20 seconds
            });

            // Trigger email field check on page load
            const event = new Event('input');
            emailInput.dispatchEvent(event);
        });

        // Password validation
        document.getElementById('signupForm').addEventListener('submit', function(e) {
            const password = document.getElementById('password').value;
            const email = document.getElementById('email').value;

            // Determine required password based on email
            const isStudent = /^kl\d+@student\.uptm\.edu\.my$/i.test(email);
            const requiredPassword = isStudent ? 'siswiuptm' : 'admin123';

            if (password !== requiredPassword) {
                e.preventDefault();
                alert('You need to input the default password!');
            }
        });
    </script>
</body>

</html>
