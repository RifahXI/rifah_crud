<?php
// Session
session_start();

// Cek apakah user sudah login
if (isset($_SESSION['user_id']) || isset($_COOKIE['user_email'])) {
    header('Location: ../pages/index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Meta Tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Title -->
    <title>Login</title>

    <!-- Cdn Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom Css -->
    <style>
        body {
            background: linear-gradient(135deg, #74ebd5, #9face6);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
        }

        .login-container {
            width: 600px;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            background-color: #ffffff;
        }

        .form-label {
            font-weight: bold;
            color: #333;
        }

        .form-text {
            font-size: 0.9em;
            color: #666;
        }

        .btn-login {
            background-color: #6c63ff;
            color: #fff;
            width: 100%;
            border: none;
            padding: 10px;
            border-radius: 6px;
        }

        .btn-login:hover {
            background-color: #5145cd;
        }

        .register-link {
            text-align: center;
            margin-top: 10px;
        }

        .register-link a {
            text-decoration: none;
            color: #6c63ff;
        }

        .register-link a:hover {
            text-decoration: underline;
        }

        .error-modal {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background: rgba(0, 0, 0, 0.7);
            visibility: hidden;
        }

        .error-modal.show {
            visibility: visible;
        }

        .modal-content {
            background-color: #6c63ff;
            padding: 30px;
            border-radius: 8px;
            text-align: center;
            width: 80%;
            max-width: 400px;
        }

        .close-btn {
            background-color: transparent;
            color: #fff;
            border: 1px solid #fff;
            padding: 10px 20px;
            margin-top: 15px;
            cursor: pointer;
        }
    </style>

</head>

<body>

    <!-- Login Form Section -->
    <div class="login-container">
        <h2 class="text-center">Login</h2>
        <form action="../php/process_login.php" method="POST">
            <!-- Email Input -->
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" required
                    placeholder="Enter your email">
            </div>

            <!-- Password Input -->
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required
                    placeholder="Enter your password">
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-login">Login</button>
        </form>

        <!-- Register Link -->
        <div class="mt-3 text-center">
            <p class="form-text">Belum punya akun? <a href="register.php">Register</a></p>
        </div>
    </div>

    <!-- Error Modal -->
    <div id="error-modal" class="error-modal">
        <div class="modal-content">
            <h3 class="text-white">Oops! Ada yang salah...</h3>
            <p class="text-white">Error message will appear here.</p>
            <button id="close-modal" class="close-btn">Close</button>
        </div>
    </div>

    <!-- Bootstrap JS and CSS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Menampilkan modal jika ada parameter 'error' di URL
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('error')) {
            const errorMessage = urlParams.get('error');
            document.querySelector('.modal-content p').textContent = errorMessage;

            // Gunakan Bootstrap modal untuk menampilkan modal
            const errorModal = document.getElementById('error-modal');
            errorModal.classList.add('show');
        }

        // Tutup modal saat tombol Close diklik
        document.getElementById('close-modal').addEventListener('click', () => {
            const errorModal = document.getElementById('error-modal');
            errorModal.classList.remove('show');
        });
    </script>

</body>

</html>