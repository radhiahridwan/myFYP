<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SISWI Management System')</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #004AAD;
            --bg-light: #f8fbff;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--bg-light);
            min-height: 100vh;
            width: 100%;
        }

        .container {
            width: 100%;
            max-width: 1400px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Mobile responsive tweaks */
        @media (max-width: 768px) {
            .container {
                padding: 15px;
            }

            h2 {
                font-size: 1.2rem;
            }

            table th,
            table td {
                font-size: 0.85rem;
                padding: 8px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        @yield('content')
    </div>
</body>

</html>
