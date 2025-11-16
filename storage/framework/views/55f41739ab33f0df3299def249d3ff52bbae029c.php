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
            <a href="<?php echo e(url('/login')); ?>" class="active">Login</a>
            <a href="<?php echo e(url('/signup')); ?>">User Registration</a>
        </div>



        <form action="<?php echo e(url('/login')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="form-group">
                <input type="email" name="email" placeholder="Email Address" required value="<?php echo e(old('email')); ?>">
                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="error-message"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="form-group">
                <input type="password" name="password" id="password" placeholder="Password" required>
                <img src="<?php echo e(asset('images/eye-close.png')); ?>" id="togglePassword" class="toggle-password"
                    alt="Toggle Password">
                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="error-message"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <!-- Auto-disappearing Messages -->
            <?php if(session('success')): ?>
                <div class="alert alert-success" id="autoMessage"><?php echo e(session('success')); ?></div>
            <?php endif; ?>

            <?php if($errors->any()): ?>
                <div class="alert alert-error" id="autoMessage">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo e($error); ?>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endif; ?>
            <button type="submit">Login</button>
        </form>

        <div class="register-link">
            <p>New user? <a href="<?php echo e(url('/signup')); ?>">Register here</a></p>
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
                this.src = '<?php echo e(asset('images/eye-open.png')); ?>'; // Password is visible
            } else {
                this.src = '<?php echo e(asset('images/eye-close.png')); ?>'; // Password is hidden
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
<?php /**PATH C:\xampp\htdocs\myFYP\resources\views/auth/login.blade.php ENDPATH**/ ?>