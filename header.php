<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$isLoggedIn = isset($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>My Dashboard</title>
  <link rel="stylesheet" href="css/styles.css" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
  <style>
    body {
      margin: 0;
      font-family: 'Poppins', sans-serif;
    }

    .container {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 10px 20px;
      background-color: #101d42;
    }

    .logo {
      height: 40px;
    }

    .nav-links {
      list-style: none;
      display: flex;
      gap: 20px;
    }

    .nav-links li a {
      color: white;
      text-decoration: none;
      font-weight: 600;
    }

    .hamburger {
      display: none;
      font-size: 28px;
      background: none;
      border: none;
      color: white;
      cursor: pointer;
      z-index: 1001;
    }

    .mobile-nav {
      position: fixed;
      top: 0;
      left: -250px;
      width: 220px;
      height: 100%;
      background-color: #101d42;
      padding: 60px 20px 20px;
      display: flex;
      flex-direction: column;
      transition: left 0.3s ease;
      z-index: 1000;
    }

    .mobile-nav.active {
      left: 0;
    }

    .mobile-nav a {
      text-decoration: none;
      color: white;
      font-weight: 600;
      margin: 10px 0;
      transition: color 0.3s;
    }

    .mobile-nav a:hover {
      color: #00bcd4;
    }

    .close-btn {
      position: absolute;
      top: 15px;
      right: 15px;
      font-size: 28px;
      background: none;
      color: white;
      border: none;
      cursor: pointer;
    }

    @media (max-width: 768px) {
      .nav-links {
        display: none;
      }

      .hamburger {
        display: block;
      }
    }
  </style>
</head>
<body>

<!-- Header -->
<header>
  <div class="container header-container">
    <img src="images/logo.jpeg" alt="Logo" class="logo" />
    <nav>
      <ul class="nav-links">
        <li><a href="index.php">Home</a></li>
        <li><a href="services.php">Plans & Services</a></li>
        <li><a href="achievement.php">Achievements</a></li>
        <li><a href="about.php">About Us</a></li>
        <li><a href="contact.php">Contact Us</a></li>
        <?php if ($isLoggedIn): ?>

    <a href="recharge.php">Reacharge Plans</a>
          <li><a href="dashboard.php">Dashboard</a></li>
          <li><a href="login.php?logout=1">Logout</a></li>
        <?php else: ?>
          <li><a href="signup.php" class="open-signup">Account</a></li>
        <?php endif; ?>
      </ul>
    </nav>
    <button class="hamburger" id="hamburger">&#9776;</button>
  </div>

  <!-- Mobile Sidebar -->
  <div class="mobile-nav" id="mobileNav">
    <button class="close-btn" id="closeSidebar">&times;</button>
    <a href="index.php">Home</a>
    <a href="services.php">Plans & Services</a>
    <a href="achievement.php">Achievements</a>
    <a href="about.php">About Us</a>
    <a href="contact.php">Contact Us</a>

    <?php if ($isLoggedIn): ?>

    <a href="recharge.php">Reacharge Plans</a>
      <a href="login.php?logout=1">Logout</a>
    <?php else: ?>
      <a href="signup.php" class="open-signup">Account</a>
    <?php endif; ?>
  </div>
</header>

<!-- Signup Modal -->
<?php if (!$isLoggedIn): ?>
<div id="signupModal" style="display:none; position:fixed; top:0; left:0; width:100vw; height:100vh; background:rgba(16,29,66,0.25); z-index:2000; align-items:center; justify-content:center;">
  <div style="background:#fff; border-radius:16px; box-shadow:0 8px 32px rgba(16,29,66,0.18); width:95vw; max-width:400px; padding:0; position:relative; display:flex; flex-direction:column; align-items:center;">
    <button onclick="closeSignupModal()" style="position:absolute; top:10px; right:18px; background:none; border:none; font-size:2rem; color:#e10000; cursor:pointer; z-index:10;">&times;</button>
    <iframe id="signupFrame" src="signup.php" style="border:none; width:100%; height:540px; border-radius:16px;"></iframe>
  </div>
</div>
<?php endif; ?>

<script>
  const hamburger = document.getElementById('hamburger');
  const mobileNav = document.getElementById('mobileNav');
  const closeBtn = document.getElementById('closeSidebar');

  hamburger.addEventListener('click', () => {
    mobileNav.classList.add('active');
  });

  closeBtn.addEventListener('click', () => {
    mobileNav.classList.remove('active');
  });

  // Show signup modal if not logged in
  document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.open-signup').forEach(function(link) {
      link.addEventListener('click', function(e) {
        e.preventDefault();
        const modal = document.getElementById('signupModal');
        if (modal) {
          modal.style.display = 'flex';
          document.getElementById('signupFrame').src = 'signup.php';
        }
      });
    });
  });

  function closeSignupModal() {
    document.getElementById('signupModal').style.display = 'none';
    document.getElementById('signupFrame').src = '';
  }
</script>

</body>
</html>
