<?php
include "db_connect.php";

$sql = "SELECT * FROM plans WHERE category = 'Digital Marketing'";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Digital Marketing Plans</title>
  <link rel="stylesheet" href="css/styles.css" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      margin: 0;
      background: #fff;
    }

    header {
      background: linear-gradient(90deg, #e10000 0%, #ff512f 100%);
      box-shadow: 0 2px 8px rgba(225,0,0,0.10);
      position: sticky;
      top: 0;
      z-index: 1000;
    }

    .header-container {
      display: flex;
      align-items: center;
      justify-content: space-between;
      max-width: 1200px;
      margin: auto;
      padding: 15px 20px;
    }

    .logo {
      height: 50px;
      border-radius: 12px;
      box-shadow: 0 2px 8px rgba(225,0,0,0.08);
      background: #fff;
      padding: 2px;
    }

    nav {
      position: relative;
    }

    .nav-links {
      list-style: none;
      display: flex;
      gap: 22px;
      margin: 0;
      padding: 0;
    }

    .nav-links li a {
      text-decoration: none;
      color: #fff;
      font-weight: 700;
      font-size: 1.08rem;
      letter-spacing: 0.5px;
      padding: 8px 18px;
      border-radius: 22px;
      transition: background 0.18s, color 0.18s, box-shadow 0.18s;
      display: inline-block;
    }

    .nav-links li a:hover,
    .nav-links li a:focus {
      background: #fff;
      color: #e10000;
      box-shadow: 0 2px 8px rgba(225,0,0,0.10);
    }

    .plans {
      max-width: 1200px;
      margin: 50px auto;
      padding: 0 20px;
      text-align: center;
    }

    .plans h2 {
      font-size: 2rem;
      margin-bottom: 36px;
      color: #e10000;
      font-weight: 700;
      letter-spacing: 1px;
      text-shadow: 0 2px 8px rgba(225,0,0,0.06);
    }

    .plan-buttons {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 38px;
    }

    .plan-card {
      background: #fff;
      border-radius: 18px;
      box-shadow: 0 8px 32px rgba(225,0,0,0.10);
      padding: 32px 28px 28px 28px;
      width: 370px;
      min-height: 420px;
      text-align: center;
      transition: box-shadow 0.18s, transform 0.18s;
      display: flex;
      flex-direction: column;
      align-items: center;
      position: relative;
    }

    .plan-card:hover,
    .plan-card:focus-within {
      box-shadow: 0 16px 48px rgba(225,0,0,0.18);
      transform: translateY(-8px) scale(1.03);
    }

    .plan-icon {
      width: 110px;
      height: 110px;
      object-fit: cover;
      border-radius: 50%;
      border: 3px solid #e10000;
      background: #fff0f0;
      box-shadow: 0 2px 12px rgba(225,0,0,0.08);
      margin-bottom: 18px;
      transition: box-shadow 0.2s, transform 0.2s;
    }

    .plan-card:hover .plan-icon,
    .plan-card:focus-within .plan-icon {
      box-shadow: 0 6px 24px rgba(225,0,0,0.18);
      transform: scale(1.04);
    }

    .plan-card h3 {
      font-size: 1.35rem;
      margin: 10px 0 8px;
      color: #e10000;
      font-weight: 700;
      letter-spacing: 0.5px;
    }

    .plan-card p {
      margin: 7px 0;
      font-size: 1.08rem;
      color: #222;
      line-height: 1.6;
    }

    .plan-card .plan-price {
      display: inline-block;
      background: #fff0f0;
      color: #e10000;
      font-size: 1.2rem;
      font-weight: 700;
      border-radius: 10px;
      padding: 7px 22px;
      margin: 0 0 12px 0;
      letter-spacing: 1px;
      box-shadow: 0 2px 8px rgba(225,0,0,0.06);
    }

    .plan-actions {
      margin-top: auto;
      display: flex;
      justify-content: space-between;
      gap: 14px;
      width: 100%;
    }

    .details-btn,
    .subscribe-btn {
      flex: 1 1 0;
      padding: 13px 0;
      border-radius: 24px;
      font-size: 1.05rem;
      font-family: 'Poppins', sans-serif;
      font-weight: 700;
      cursor: pointer;
      border: none;
      text-decoration: none;
      transition: 
        background 0.18s,
        color 0.18s,
        box-shadow 0.18s,
        transform 0.12s;
      box-shadow: 0 2px 8px rgba(225,0,0,0.08);
      outline: none;
      text-align: center;
      min-width: 0;
      margin: 0;
      letter-spacing: 0.5px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .details-btn {
      background: #fff;
      color: #e10000;
      border: 2px solid #e10000;
      margin-right: 6px;
    }

    .details-btn:hover,
    .details-btn:focus {
      background: #e10000;
      color: #fff;
      box-shadow: 0 4px 16px rgba(225,0,0,0.13);
      transform: scale(1.04);
    }

    .subscribe-btn {
      background: linear-gradient(90deg, #e10000 0%, #ff512f 100%);
      color: #fff;
      border: none;
      margin-left: 6px;
      box-shadow: 0 4px 16px rgba(225,0,0,0.13);
    }

    .subscribe-btn:hover,
    .subscribe-btn:focus {
      background: linear-gradient(90deg, #ff512f 0%, #e10000 100%);
      color: #fff;
      transform: scale(1.04);
      box-shadow: 0 8px 32px rgba(225,0,0,0.18);
    }

    footer {
      background: #101d42;
      color: #fff;
      text-align: center;
      padding: 20px 0;
      font-size: 1rem;
      letter-spacing: 0.5px;
      box-shadow: 0 -2px 8px rgba(0,0,0,0.08);
      margin-top: 60px;
      width: 100%;
    }

    @media (max-width: 900px) {
      .plan-card {
        width: 98vw;
        min-width: 0;
        max-width: 420px;
        margin: 0 auto;
      }
      .plan-buttons {
        flex-direction: column;
        gap: 24px;
      }
    }

    @media (max-width: 600px) {
      .plans {
        padding: 10px 0;
      }
      .plan-card {
        padding: 18px 6vw 18px 6vw;
        min-height: 340px;
      }
      .plan-icon {
        width: 80px;
        height: 80px;
      }
      .details-btn, .subscribe-btn {
        padding: 10px 0;
        font-size: 0.98rem;
      }
      .plan-actions {
        flex-direction: column;
        gap: 10px;
      }
      .details-btn,
      .subscribe-btn {
        width: 100%;
        margin: 0;
      }
    }

    /* Mobile Navigation Styles */
    .mobile-nav {
      display: none;
      flex-direction: column;
      position: absolute;
      top: 60px;
      right: 0;
      background: #fff;
      width: 220px;
      box-shadow: 0 8px 32px rgba(225,0,0,0.10);
      border-radius: 0 0 18px 18px;
      padding: 18px 0;
      z-index: 1050;
      animation: fadeInDown 0.3s;
    }
    @keyframes fadeInDown {
      from { opacity: 0; transform: translateY(-20px);}
      to { opacity: 1; transform: translateY(0);}
    }
    .mobile-nav li {
      list-style: none;
    }
    .mobile-nav li a {
      color: #e10000;
      font-weight: 700;
      font-size: 1.08rem;
      padding: 12px 28px;
      border-radius: 18px;
      display: block;
      text-decoration: none;
      transition: background 0.18s, color 0.18s;
    }
    .mobile-nav li a:hover,
    .mobile-nav li a:focus {
      background: #ffeaea;
      color: #e10000;
    }

    @media (max-width: 900px) {
      .header-container {
        padding: 12px 8px;
      }
      .logo {
        height: 40px;
      }
    }

    @media (max-width: 768px) {
      .nav-links {
        display: none;
      }
      .hamburger {
        display: flex;
      }
      .mobile-nav {
        display: none;
      }
      .mobile-nav.active {
        display: flex;
      }
    }

    .hamburger {
      display: none;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      width: 36px;
      height: 30px;
      background: none;
      border: none;
      cursor: pointer;
      z-index: 1100;
      position: relative;
      margin-right: 15px;
    }

    .hamburger span {
      display: block;
      width: 100%;
      height: 4px;
      background: #e10000;
      border-radius: 2px;
      transition: transform 0.3s, opacity 0.3s;
      margin: 3px 0;
    }
    .hamburger.open span:nth-child(1) {
      transform: rotate(45deg) translate(7px, 7px);
    }
    .hamburger.open span:nth-child(2) {
      opacity: 0;
    }
    .hamburger.open span:nth-child(3) {
      transform: rotate(-45deg) translate(7px, -7px);
    }
  </style>
</head>
<body>

<header>
  <div class="container header-container">
    <button class="hamburger" onclick="toggleSidebar()">&#9776;</button>
    <img src="images/logo.jpeg" alt="Logo" class="logo" />
    <nav>
      <ul class="nav-links">
        <li><a href="index.php">Home</a></li>
        <li><a href="services.php">Plans & Services</a></li>
        <li><a href="achievement.php">Achievements</a></li>
        <li><a href="about.php">About Us</a></li>
        <li><a href="contact.php">Contact Us</a></li>
        <li><a href="signup.php">Account</a></li>
      </ul>
      <button class="hamburger" id="hamburger" aria-label="Open menu">
        <span></span>
        <span></span>
        <span></span>
      </button>
      <ul class="mobile-nav" id="mobileNav">
        <li><a href="index.php">Home</a></li>
        <li><a href="services.php">Plans & Services</a></li>
        <li><a href="achievement.php">Achievements</a></li>
        <li><a href="about.php">About Us</a></li>
        <li><a href="contact.php">Contact Us</a></li>
        <li><a href="signup.php">Account</a></li>
      </ul>
    </nav>
  </div>
</header>

<section class="plans">
  <h2>Digital Marketing Plans</h2>
  <div class="plan-buttons">
    <?php if ($result->num_rows > 0): ?>
      <?php while($row = $result->fetch_assoc()): ?>
        <div class="plan-card">
          <img src="<?php echo htmlspecialchars($row['image']); ?>" alt="Plan Image" class="plan-icon" />
          <h3><?php echo htmlspecialchars($row['plan_name']); ?></h3>
          <p><strong>Price:</strong> ₹<?php echo htmlspecialchars($row['price']); ?></p>
          <p><strong>Validity:</strong> <?php echo htmlspecialchars($row['validity']); ?></p>
          <a href="package_details.php?plan_id=<?php echo $row['id']; ?>" class="details-btn">Package Details</a>
          <a href="subscribe.php?plan_id=<?php echo $row['id']; ?>" class="subscribe-btn">Subscribe</a>
        </div>
      <?php endwhile; ?>
    <?php else: ?>
      <p>No digital marketing plans found.</p>
    <?php endif; ?>
  </div>
</section>

<footer>
  <p>&copy; 2025 SunFace Technologies. All Rights Reserved.</p>
</footer>

<!-- Signup Modal -->
<div id="signupModal" style="display:none; position:fixed; top:0; left:0; width:100vw; height:100vh; background:rgba(16,29,66,0.25); z-index:2000; align-items:center; justify-content:center;">
  <div style="background:#fff; border-radius:16px; box-shadow:0 8px 32px rgba(16,29,66,0.18); width:95vw; max-width:400px; padding:0; position:relative; display:flex; flex-direction:column; align-items:center;">
    <button onclick="closeSignupModal()" style="position:absolute; top:10px; right:18px; background:none; border:none; font-size:2rem; color:#e10000; cursor:pointer; z-index:10;">&times;</button>
    <iframe id="signupFrame" src="signup.php" style="border:none; width:100%; height:540px; border-radius:16px;"></iframe>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('a[href="signup.php"], a[href="./signup.php"], a[href="/signup.php"]').forEach(function(link) {
      link.addEventListener('click', function(e) {
        e.preventDefault();
        document.getElementById('signupModal').style.display = 'flex';
        document.getElementById('signupFrame').src = 'signup.php';
      });
    });
  });

  function closeSignupModal() {
    document.getElementById('signupModal').style.display = 'none';
    document.getElementById('signupFrame').src = '';
  }

  document.addEventListener('DOMContentLoaded', function() {
  const hamburger = document.getElementById('hamburger');
  const mobileNav = document.getElementById('mobileNav');
  hamburger.addEventListener('click', function() {
    mobileNav.classList.toggle('active');
    hamburger.classList.toggle('open');
  });
  // Optional: Close menu when clicking a link
  mobileNav.querySelectorAll('a').forEach(link => {
    link.addEventListener('click', () => {
      mobileNav.classList.remove('active');
      hamburger.classList.remove('open');
    });
  });
});
</script>

</body>
</html>
