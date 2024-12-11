<?php
// Session
session_start();

// Koneksi database
require_once '../config/connection.php';

// Cek apakah user sudah login
if (isset($_SESSION['user_id'])) {
    $email = $_SESSION['email'];
} elseif (isset($_COOKIE['user_email'])) {
    $email = $_COOKIE['user_email'];

    // Validasi email
    $query = "SELECT * FROM tbl_users WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        // Set session dari cookie
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['role'] = $user['role'];
    } else {
        // Cookie tidak valid, redirect ke login
        setcookie('user_email', '', time() - 3600, "/");
        header('Location: ../auth/login.php');
        exit();
    }
} else {
    // Tidak ada session atau cookie, redirect ke login
    header('Location: ../auth/login.php');
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
  <title>Landing Page | Home</title>

  <!-- Cdn Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom CSS -->
  <style>
      body {
          background: linear-gradient(135deg);
          margin: 0;
          font-family: Arial, sans-serif;
      }

      .navbar-brand {
          font-weight: bold;
          color: #6c63ff;
      }

      .navbar-light .navbar-nav .nav-link {
          color: #333;
      }

      .navbar-light .navbar-nav .nav-link:hover {
          color: #6c63ff;
      }

      .btn-primary {
          background-color: #6c63ff;
          border: none;
      }

      .btn-primary:hover {
          background-color: #5145cd;
      }

      header {
          background: url('https://cdn.pixabay.com/photo/2022/10/07/11/02/autumn-7504819_1280.jpg') no-repeat center center/cover;
          height: 100vh;
          display: flex;
          justify-content: center;
          align-items: center;
          color: #fff;
          text-align: center;
          position: relative;
      }

      header::before {
          content: '';
          position: absolute;
          top: 0;
          left: 0;
          right: 0;
          bottom: 0;
      }

      header h1 {
          font-size: 3rem;
          z-index: 1;
      }

      header p {
          font-size: 1.25rem;
          z-index: 1;
      }

      header a {
          z-index: 1;
      }

      #about, #gallery, #contact {
          padding: 50px 15px;
      }

      #about {
          background-color: #f9f9f9;
          text-align: center;
      }

      #gallery .row img {
          width: 100%;
          border-radius: 8px;
          margin-bottom: 15px;
      }

      #contact {
          background-color: #f9f9f9;
      }

      footer {
          background-color: #6c63ff;
          color: #fff;
          text-align: center;
          padding: 15px 0;
      }

      @media (max-width: 768px) {
          header h1 {
              font-size: 2rem;
          }

          header p {
              font-size: 1rem;
          }
      }

      .sticky-navbar {
          position: sticky;
          top: 0;
          z-index: 1020;
          background: white;
          box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      }
  </style>

</head>

<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light sticky-navbar">
    <div class="container">
      <a class="navbar-brand" href="#">Rifah</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#about">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#gallery">Gallery</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#contact">Contact</a>
          </li>
        </ul>
        <button class="btn btn-primary" type="button">Logout</button>
        <script>
          document.querySelector('.btn-primary').addEventListener('click', function () {
            window.location.href = '../php/process_logout.php';
          });
        </script>
      </div>
    </div>
  </nav>

  <!-- Hero Section -->
  <header>
    <div class="container">
      <h1>Selamat Datang di Toko Bunga</h1>
      <p>Menyediakan bunga terbaik untuk setiap momen spesial Anda.</p>
      <a href="#about" class="btn btn-light btn-lg">Explore More</a>
    </div>
  </header>

  <!-- About Section -->
  <section id="about">
    <div class="container">
      <h2>Tentang Kami</h2>
      <p>Kami adalah toko bunga terpercaya yang menyediakan berbagai jenis bunga segar dan rangkaian bunga untuk berbagai acara. Kepuasan pelanggan adalah prioritas kami.</p>
    </div>
  </section>

  <!-- Gallery Section -->
  <section id="gallery">
    <div class="container">
      <h2>Galeri</h2>
      <div class="row">
        <div class="col-md-4">
          <img src="https://cdn.pixabay.com/photo/2013/07/30/12/25/bouquet-168831_1280.jpg" alt="Gallery Image 1">
        </div>
        <div class="col-md-4">
          <img src="https://cdn.pixabay.com/photo/2018/06/04/17/23/flowers-3453729_1280.jpg" alt="Gallery Image 2">
        </div>
        <div class="col-md-4">
          <img src="https://cdn.pixabay.com/photo/2017/07/07/19/06/lavenders-2482374_1280.jpg" alt="Gallery Image 3">
        </div>
      </div>
    </div>
  </section>

  <!-- Contact Section -->
  <section id="contact">
    <div class="container">
      <h2>Kontak Kami</h2>
      <form>
        <div class="mb-3">
          <label for="name" class="form-label">Nama</label>
          <input type="text" class="form-control" id="name" placeholder="Masukkan nama Anda">
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" id="email" placeholder="Masukkan email Anda">
        </div>
        <div class="mb-3">
          <label for="message" class="form-label">Pesan</label>
          <textarea class="form-control" id="message" rows="4" placeholder="Tulis pesan Anda"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Kirim</button>
      </form>
    </div>
  </section>

  <!-- Footer -->
  <footer>
    <p>&copy; 2024 Rifah. All rights reserved.</p>
  </footer>

  <!-- Bootstrap JS Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
