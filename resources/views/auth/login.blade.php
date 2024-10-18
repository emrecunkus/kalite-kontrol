<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ASPİLSAN Kalite Portalı - Login</title>

    <!-- Magistral Font -->
    <link href="https://fonts.googleapis.com/css2?family=Magistral:wght@400;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <style>
        body, html {
            height: 100%;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            font-family: 'Magistral', sans-serif;
            overflow: hidden;
        }

        .login-container {
            width: 100%;
            max-width: 400px;
            padding: 40px;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            text-align: center;
            position: relative;
            z-index: 1;
            animation: fadeIn 1s ease;
        }

        .login-logo {
            width: 80px;
            margin-bottom: 20px;
        }

        .input-group .input-group-text {
            background-color: #007bff;
            color: white;
        }

        /* Göz ikonunun textbox içinde sabitlenmesi için */
        .input-group .fa-eye {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #007bff;
        }

        .form-control {
            padding-right: 2.5rem; /* Göz ikonu için yer aç */
        }

        .form-group label {
            margin-bottom: 8px; /* Label ve text box arasındaki boşluk */
            font-weight: bold;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .btn-primary:active {
            transform: scale(0.98); /* Tıklama efekti */
        }

        /* Animasyonlar */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes spinnerGrow {
            0% {
                transform: scale(0);
            }
            100% {
                transform: scale(1);
            }
        }

        /* Spinner Fullscreen Stili */
        .spinner-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(255, 255, 255, 0.8);
            z-index: 10;
            display: flex;
            justify-content: center;
            align-items: center;
            display: none;
            animation: fadeIn 0.5s ease;
        }

        .spinner-border {
            width: 4rem;
            height: 4rem;
            animation: spinnerGrow 0.6s infinite;
        }

        .loading form {
            opacity: 0.5;
        }

    </style>
</head>
<body>

<div class="login-container">
    <!-- Logo -->
    <img src="{{ asset('images/logo.png') }}" alt="ASPİLSAN Logo" class="login-logo">

    <h2>ASPİLSAN Kalite Portalı</h2>

    <form method="POST" action="{{ route('login') }}" id="loginForm">
        @csrf
        <div class="form-group mb-3">
            <label for="username">Username (Active Directory Username)</label>
            <div class="input-group">
                <div class="input-group-text"><i class="fas fa-user"></i></div>
                <input type="text" name="username" class="form-control" required placeholder="Enter your username">
            </div>
        </div>

        <div class="form-group mb-3">
            <label for="password">Password</label>
            <div class="input-group position-relative">
                <div class="input-group-text"><i class="fas fa-lock"></i></div>
                <input type="password" name="password" class="form-control" id="password" required placeholder="Enter your password">
                <i class="fas fa-eye" id="togglePassword"></i>
            </div>
        </div>

        <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>

    <!-- Başarı Mesajı -->
    @if(Session::has('success'))
        <div class="alert alert-success mt-3">
            {{ Session::get('success') }}
        </div>
    @endif

    <!-- Hata Mesajları -->
    @if($errors->any())
        <div class="alert alert-danger mt-3">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>

<!-- Fullscreen Spinner -->
<div class="spinner-overlay">
    <div class="spinner-border text-primary" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Şifreyi göster/gizle
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');

    togglePassword.addEventListener('click', function () {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        this.classList.toggle('fa-eye-slash');
    });

    // Form gönderildiğinde spinner aktif edilecek
    document.getElementById('loginForm').addEventListener('submit', function () {
        document.querySelector('.spinner-overlay').style.display = 'flex';
    });
</script>

</body>
</html>
