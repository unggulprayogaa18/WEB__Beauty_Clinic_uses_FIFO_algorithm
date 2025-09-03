<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Werissa Beauty Clinic</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-color: #670D2F; /* Maroon */
            --primary-hover: #530a25; /* Maroon lebih gelap */
            --text-dark: #333;
            --text-light: #777;
            --border-color: #ddd;
            --light-bg: #f9f9f9;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--light-bg);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
        }

        .login-container {
            display: flex;
            width: 100%;
            max-width: 900px;
            min-height: 550px;
            background-color: #fff;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
            border-radius: 20px;
            overflow: hidden;
        }

        /* Sisi Gambar (kiri) */
        .login-image-side {
            flex: 1;
            background-image: url('https://images.pexels.com/photos/3985321/pexels-photo-3985321.jpeg');
            background-size: cover;
            background-position: center;
            position: relative;
        }
        
        /* Sisi Form (kanan) */
        .login-form-side {
            flex: 1;
            padding: 50px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .login-header h2 {
            color: var(--primary-color);
            font-weight: 600;
            font-size: 2rem;
            margin-bottom: 5px;
        }

        .login-header p {
            color: var(--text-light);
            font-size: 0.95rem;
        }
        
        .form-group {
            position: relative;
            margin-bottom: 25px;
        }

        .form-control {
            border: none;
            border-bottom: 2px solid var(--border-color);
            border-radius: 0;
            padding: 10px 10px 10px 35px; /* Ruang untuk ikon */
            font-size: 1rem;
            background-color: transparent;
            transition: border-color 0.3s;
        }

        .form-control:focus {
            outline: none;
            box-shadow: none;
            border-color: var(--primary-color);
        }
        
        .form-icon {
            position: absolute;
            left: 5px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-light);
            transition: color 0.3s;
        }

        .form-control:focus + .form-icon {
            color: var(--primary-color);
        }

        .btn-login {
            background-color: var(--primary-color);
            border: none;
            color: #fff;
            padding: 12px;
            border-radius: 10px;
            font-weight: 500;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
            box-shadow: 0 4px 15px rgba(103, 13, 47, 0.2);
        }

        .btn-login:hover {
            background-color: var(--primary-hover);
            transform: translateY(-2px);
        }

        .error-message {
            color: #d9534f; /* Merah untuk error */
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            padding: 10px 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
            font-size: 0.9em;
        }

        /* Responsiveness for mobile */
        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
                min-height: auto;
                max-width: 400px;
            }
            .login-image-side {
                display: none; /* Sembunyikan gambar di layar kecil */
            }
            .login-form-side {
                padding: 40px 30px;
            }
        }
    </style>
</head>
<body>

    <div class="login-container">
        
        <div class="login-image-side"></div>
        
        <div class="login-form-side">
            <div class="login-header">
                <h2>Selamat Datang</h2>
                <p>Login ke akun Werissa Beauty Clinic Anda</p>
            </div>

            @if ($errors->any())
                <div class="error-message">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login.process') }}">
                @csrf
                <div class="form-group">
                    <input type="text" name="username" id="username" class="form-control" placeholder="Nama Pengguna" value="{{ old('username') }}" required>
                    <i class="fas fa-user form-icon"></i>
                </div>
                
                <div class="form-group">
                    <input type="password" name="password" id="password" class="form-control" placeholder="Kata Sandi" required>
                    <i class="fas fa-lock form-icon"></i>
                </div>
                
                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-login">Login</button>
                </div>
            </form>
        </div>
        
    </div>

</body>
</html>