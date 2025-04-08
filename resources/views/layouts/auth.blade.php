<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f5f5f5;
        }

        .login-container {
            width: 70%;
            height: 80%;
            border-radius: 10px;
            display: flex;
            overflow: hidden;
            box-shadow: 0 10px 18px rgba(0, 0, 0, 0.1);
        }

        .login-left {
            flex: 1;
            background: #202434;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-left img {
            max-width: 100%;
            height: auto;
        }

        .login-right {
            flex: 1;
            background: white;
            padding: 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-right h2 {
            font-weight: bold;
            text-align: center;
            margin-bottom: 10px;
        }

        .login-right p {
            text-align: center;
            margin-bottom: 20px;
            color: #6c757d;
        }

        .form-control {
            margin-bottom: 15px;
        }

        .btn-sign {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            background-color: #202434;
            border: none;
            color: white;
        }
    </style>
</head>

<body>
    @yield('content')
    @include('sweetalert::alert')

</body>

</html>
