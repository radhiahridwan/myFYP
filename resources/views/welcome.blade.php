<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Siswi Management System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6fa;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            text-align: center;
            background: #ffffff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            width: 400px;
        }
        h1 {
            color: #294db0;
            margin-bottom: 20px;
        }
        p {
            color: #555;
            margin-bottom: 30px;
        }
        a {
            display: block;
            text-decoration: none;
            background: #294db0;
            color: #fff;
            padding: 12px;
            border-radius: 6px;
            margin: 10px 0;
            font-weight: bold;
            transition: 0.3s;
        }
        a:hover {
            background: #1d357d;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Siswi Management System</h1>
        <p>Welcome! Please choose an option below:</p>
        <a href="{{ url('/login') }}">Login</a>
        <a href="{{ url('/signup') }}">Sign Up</a>
    </div>
</body>
</html>
