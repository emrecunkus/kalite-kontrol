<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ASPİLSAN Kalite Portalı</title>

    <!-- Magistral Font -->
    <link href="https://fonts.googleapis.com/css2?family=Magistral:wght@400;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            font-family: 'Magistral', sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 0;
        }

        /* Sidebar Styling */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            height: 100vh;
            background: linear-gradient(145deg, #1e3c72, #2a5298);
            color: white;
            padding-top: 20px;
            transition: all 0.3s ease;
            transform: translateX(0);
            z-index: 1000;
            box-shadow: 4px 0 15px rgba(0, 0, 0, 0.2);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .sidebar.collapsed {
            transform: translateX(-250px);
        }
        .menu {
            flex-grow: 1;
        }

        .sidebar a {
            color: white;
            padding: 15px;
            display: block;
            text-decoration: none;
            font-size: 1.1em;
            transition: all 0.3s ease;
            position: relative;
        }

        .sidebar a:hover {
            background-color: #16a085;
            color: white;
            box-shadow: 0 4px 10px rgba(22, 160, 133, 0.5);
            padding-left: 30px;
        }

        .sidebar a i {
            margin-right: 15px;
            transition: transform 0.3s ease;
        }

        .sidebar a:hover i {
            transform: scale(1.2);
        }

      /* Modern Toggle Button Styling */
      .toggle-btn {
        position: absolute;
        top: 15px;
        right: -50px;
        width: 60px;
        height: 60px;
        cursor: pointer;
        background-color: #1f2d3d;
        color: white;
        display: flex;
        justify-content: center;
        align-items: center;
        transition: all 0.3s ease;
        border-radius: 8px; /* Köşeli yapı */
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
        border: 2px solid #2980b9;
    }
    
    .toggle-btn:hover {
        background-color: #2980b9;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.4);
        transform: translateY(-3px);
    }
    
    .toggle-btn:active {
        background-color: #1f2d3d;
        transform: scale(0.95);
        border-color: #1abc9c;
    }
    
    .toggle-btn i {
        font-size: 1.8em;
        transition: transform 0.3s ease;
    }
    
    .toggle-btn:hover i {
        transform: rotate(180deg); /* İkon dönüş efekti */
    }
    
    /* Minimalist toggle icon */
    .toggle-btn i:before {
        content: "\f0c9"; /* FontAwesome bars ikonu */
    }

        /* Content */
        .content {
            margin-left: 250px;
            padding: 20px;
            padding-top: 80px; /* Header'a yer açmak için */
            padding-bottom: 100px; /* Footer'dan uzaklaşmak için */
            transition: margin-left 0.3s ease;
        }

        .sidebar.collapsed + .content {
            margin-left: 0;
        }

        /* Footer */
        .footer {
            background-color: #2c3e50;
            color: white;
            padding: 10px 0;
            text-align: center;
            position: fixed;
            bottom: 0;
            width: 100%;
            margin-left: 0;
            z-index: 1000;
        }

        .sidebar.collapsed + .footer {
            margin-left: 0;
        }

        .footer p {
            margin: 0;
        }

        /* Sidebar Modern Animations */
        .sidebar .menu a i {
            transition: transform 0.3s ease, color 0.3s ease;
        }

        .sidebar .menu a:hover i {
            transform: rotate(15deg);
            color: #070707;
        }

        /* Additional Enhancements */
        .sidebar a.active {
            background-color: #3498db;
            box-shadow: 0 4px 10px rgba(52, 152, 219, 0.5);
        }

        .sidebar a.active i {
            color: #1f1e1b;
        }

        /* Logo and Title Styling */
        .logo-container {
            text-align: center;
            padding: 10px 0; /* Yukarıdaki boşluk azaldı */
            margin-bottom: 50px; /* Daha az aşağı çekildi */
        }
        
        .logo-container img {
            max-width: 150px;
            margin-bottom: 5px; /* Görselin altındaki boşluk azaldı */
        }
        
        .logo-container .title {
            font-size: 1.5em;
            font-weight: bold;
        }

        .form-title {
            text-align: center;
            border-bottom: 2px solid #007bff;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .menu {
            flex-grow: 1;
        }

        .header {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            height: 70px;
        }

        .title-center {
            margin: 0;
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            font-size: 1.8em;
        }

        .user-menu {
            position: absolute;
            right: 20px;
            display: flex;
            align-items: center;
        }

        .welcome-text {
            margin-right: 10px;
            font-size: 1.2em;
        }

        .profile-dropdown {
            position: relative;
            display: inline-block;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            cursor: pointer;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            background-color: white;
            min-width: 160px;
            box-shadow: 0px 8px 16px rgba(0,0,0,0.2);
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #f1f1f1;
        }

        .profile-dropdown:hover .dropdown-content {
            display: block;
        }
    </style>
</head>
<body>

    <!-- Header -->
    <div class="header">
        <h1 class="title-center">ASPİLSAN Kalite Portalı</h1>
        <div class="user-menu">
            <span class="welcome-text">Welcome, {{ session('username') }}!</span>
            
            <div class="profile-dropdown">
                <img src="{{ asset('images/default-avatar.png') }}" alt="User Avatar" class="user-avatar">
                <div class="dropdown-content">
                    <a href="{{ route('profile') }}">Profile</a>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <button class="toggle-btn" id="toggle-btn">
            <i class="fas fa-bars"></i>
        </button>
    
        <div class="menu">
            @if(session('role') == 'mühendis')
                <a href="{{ route('mühendis.assigned') }}"><i class="fas fa-tasks"></i> Onayda Bekleyen Formlar</a>
                <a href="{{ route('mühendis.report') }}"><i class="fas fa-file-contract"></i>Onaylanmış Formlar</a>
                <a href="{{ route('mühendis.tum_report') }}"><i class="fas fa-file-contract"></i>Tüm Formlar</a>
            @elseif(session('role') == 'tekniker')
                <a href="{{ route('tekniker.form') }}"><i class="fas fa-pencil-alt"></i> Form Oluştur</a>
                <a href="{{ route('rejected.forms') }}"><i class="fas fa-ban"></i> Reddedilen Formlar</a>
                <a href="{{ route('technician.submitted.forms') }}"><i class="fas fa-clock"></i> Gönderilen Formlar</a>
            @endif
            <a href="{{ route('profile') }}"><i class="fas fa-user"></i> Profil</a>
            <a href="#"><i class="fas fa-cog"></i> Ayarlar</a>
            <a href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
               <i class="fas fa-sign-out-alt"></i> Çıkış Yap
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    
        <!-- Logo and ASPİLSAN Kalite Portalı (Sidebar'ın en altına eklenmiştir) -->
        <div class="logo-container">
            <img src="{{ asset('images/logo.png') }}" alt="ASPİLSAN Logo">
            <div class="title">ASPİLSAN Kalite Portalı</div> 
        </div>
    </div>
    
    

    <!-- Content -->
    <div class="content">
        @yield('content')
    </div>

    

    <!-- Footer -->
    <div class="footer">
        <p>&copy; 2024 ASPİLSAN Kalite Portalı</p>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Sidebar Toggle Script -->
    <script>
        const sidebar = document.getElementById('sidebar');
        const toggleBtn = document.getElementById('toggle-btn');
        const content = document.querySelector('.content');

        toggleBtn.addEventListener('click', function () {
            sidebar.classList.toggle('collapsed');
            content.classList.toggle('collapsed');
        });
    </script>

</body>
</html>
