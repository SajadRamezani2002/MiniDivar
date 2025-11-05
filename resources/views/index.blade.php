<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مینی دیوار</title>

    <!-- Bootstrap 5 RTL -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            font-family: 'Vazirmatn', Tahoma, sans-serif;
            background: #f8f9fa;
        }
        .navbar-brand {
            font-weight: 600;
            font-size: 1.4rem;
        }
        .btn-login {
            background: transparent;
            color: white;
            border: none;
            font-size: 0.95rem;
            white-space: nowrap;
        }
        .btn-login:hover {
            color: #fff;
            text-decoration: underline;
        }

        @media (max-width: 992px) {
            .navbar-brand {
                font-size: 1.2rem;
            }
            .btn-login {
                font-size: 0.85rem;
                padding: 0.25rem 0.5rem;
            }
        footer {
             background: #333; color: white; text-align: center; padding: 20px; margin-top: 20px; 
            }
        }
    </style>
</head>
<body>

    @include('header')
    <!-- @include('footer') -->



</body>
</html>
