<?php
session_start();
include 'db_connect.php';
$isLoggedIn = isset($_SESSION['user_id']) || isset($_SESSION['user_mobile']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>My Dashboard</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
  <style>
/* Reset and base */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}
body {
  font-family: 'Poppins', sans-serif;
  background: #f5f7fa;
  color: #333;
}

/* Header */
header {
  background: #101d42;
  color: white;
  position: sticky;
  top: 0;
  width: 100%;
  z-index: 999;
  box-shadow: 0 4px 8px rgba(0,0,0,0.3);
}
.header-container {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 15px 30px;
}
.logo {
  height: 50px;
}
.nav-links {
  list-style: none;
  display: flex;
  gap: 30px;
}
.nav-links li a {
  text-decoration: none;
  color: white;
  font-weight: 600;
  transition: color 0.3s;
}
.nav-links li a:hover {
  color: #00bcd4;
}
.blue-icon {
  color: #00bcd4;
  margin-right: 5px;
}

/* Sidebar Styles */
.sidebar {
  position: fixed;
  top: 0;
  left: -250px;
  width: 220px;
  height: 100%;
  background-color: #101d42;
  padding-top: 60px;
  transition: 0.3s ease;
  z-index: 999;
}
.sidebar.active {
  left: 0;
}
.sidebar a {
  display: block;
  color: white;
  padding: 12px 20px;
  text-decoration: none;
  font-weight: 600;
}
.sidebar a:hover {
  background-color: #00bcd4;
  color: #101d42;
}
.sidebar-close {
  position: absolute;
  top: 10px;
  right: 15px;
  font-size: 28px;
  background: none;
  color: white;
  border: none;
  cursor: pointer;
}

/* Hamburger Menu */
.hamburger {
  display: none;
  font-size: 28px;
  background: none;
  border: none;
  color: white;
  cursor: pointer;
}

/* Slider */
.slider {
  width: 100%;
  max-width: 900px;
  margin: 30px auto 0 auto;
  position: relative;
  overflow: hidden;
  border-radius: 18px;
  background: #fff;
  box-shadow: 0 4px 24px rgba(225,0,0,0.07);
}
.slides {
  display: flex;
  transition: transform 0.5s ease-in-out;
  width: 100%;
}
.slide-img {
  width: 100%;
  flex-shrink: 0;
  flex-grow: 0;
  max-width: 100%;
  height: 350px;
  object-fit: cover;
  border-radius: 0;
  background: #f8f8f8;
}
.arrow {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  background: rgba(16,29,66,0.7);
  color: #fff;
  border: none;
  font-size: 2rem;
  padding: 8px 16px;
  cursor: pointer;
  z-index: 2;
  border-radius: 50%;
  transition: background 0.2s;
}
.arrow.left {
  left: 10px;
}
.arrow.right {
  right: 10px;
}
.arrow:hover {
  background: #00bcd4;
}

/* Plans Section */
.plans {
  text-align: center;
  padding: 40px 20px;
}
.plans h2 {
  font-size: 2.5rem;
  margin-bottom: 30px;
}
.plan-buttons {
  display: flex;
  justify-content: center;
  gap: 30px;
  flex-wrap: wrap;
}
.plan-card {
  background: white;
  padding: 30px;
  border-radius: 12px;
  width: 200px;
  box-shadow: 0 4px 15px rgba(0,0,0,0.1);
  transition: transform 0.3s, box-shadow 0.3s;
  cursor: pointer;
}
.plan-card:hover {
  transform: translateY(-8px);
  box-shadow: 0 6px 20px rgba(0,0,0,0.2);
}
.plan-card i {
  font-size: 2rem;
  margin-bottom: 10px;
  color: #0077ff;
  display: block;
}
.plan-icon {
  width: 36px;
  height: 36px;
  margin-bottom: 10px;
  display: block;
  object-fit: contain;
}

/* Current Plans Section */
.current-plans {
  background: #fff;
  border-radius: 18px;
  box-shadow: 0 8px 32px rgba(225,0,0,0.10);
  max-width: 900px;
  margin: 40px auto 40px auto;
  padding: 36px 24px 32px 24px;
  text-align: center;
}
.current-plans h3 {
  font-size: 2rem;
  color: #e10000;
  font-weight: 700;
  letter-spacing: 1px;
  margin-bottom: 32px;
  text-shadow: 0 2px 8px rgba(225,0,0,0.06);
}
.current-plans-list {
  display: flex;
  flex-wrap: wrap;
  gap: 28px;
  justify-content: center;
  margin-top: 10px;
}
.plan-card {
  background: #fff;
  border-radius: 16px;
  box-shadow: 0 4px 24px rgba(225,0,0,0.07);
  margin: 18px auto;
  padding: 28px 32px 22px 32px;
  max-width: 420px;
  text-align: left;
  transition: box-shadow 0.18s, transform 0.18s;
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  position: relative;
  cursor: pointer;
  border-left: 6px solid #e10000;
}
.plan-card:hover,
.plan-card:focus-within {
  box-shadow: 0 8px 36px rgba(225,0,0,0.18);
  transform: translateY(-4px) scale(1.025);
  border-left: 6px solid #ff512f;
}
.plan-card p {
  margin: 7px 0;
  font-size: 1.12rem;
  color: #222;
  line-height: 1.7;
  font-weight: 500;
  letter-spacing: 0.2px;
}
.plan-card strong {
  color: #e10000;
  font-weight: 700;
  font-size: 1.08em;
}

/* Tabs */
.tabs {
  display: flex;
  justify-content: center;
  margin-bottom: 20px;
  border-bottom: 2px solid #e10000;
}

.tab-button {
  padding: 10px 20px;
  background: none;
  border: none;
  font-weight: 600;
  color: #333;
  cursor: pointer;
  font-size: 1rem;
  position: relative;
  margin: 0 5px;
}

.tab-button.active {
  color: #e10000;
}

.tab-button.active::after {
  content: '';
  position: absolute;
  bottom: -2px;
  left: 0;
  width: 100%;
  height: 3px;
  background: #e10000;
}

.tab-content {
  display: none;
}

.tab-content.active {
  display: block;
}

/* Renew Button */
.renew-button {
  display: inline-block;
  margin-top: 15px;
  padding: 8px 20px;
  background: #e10000;
  color: white;
  border-radius: 5px;
  text-decoration: none;
  font-weight: 600;
  transition: background 0.3s;
}

.renew-button:hover {
  background: #ff0000;
}

/* Footer */
footer {
  background: #101d42;
  color: white;
  text-align: center;
  padding: 20px 0;
  margin-top: 50px;
}

/* Responsive: Hamburger Menu */
.hamburger {
  display: none;
  font-size: 28px;
  background: none;
  border: none;
  color: white;
  cursor: pointer;
}

.mobile-nav {
  display: none;
  flex-direction: column;
  background: #101d42;
  padding: 15px 30px;
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

.mobile-nav.active {
  display: flex;
}

@media (max-width: 768px) {
  .nav-links {
    display: none;
  }

  .hamburger {
    display: block;
  }

  .header-container {
    padding: 15px 20px;
  }
}

@media (max-width: 600px) {
  .current-plans {
    padding: 18px 2vw 18px 2vw;
    border-radius: 12px;
  }
  .plan-card {
    padding: 18px 10px 14px 18px;
    border-radius: 10px;
    max-width: 98vw;
  }
  .current-plans h3 {
    font-size: 1.2rem;
    margin-bottom: 18px;
  }
  .plan-card p {
    font-size: 1rem;
  }
}
  </style>
</head>
<body>

  <!-- Sidebar -->
  
<div class="sidebar" id="sidebar">
  <button class="sidebar-close" onclick="toggleSidebar()">&times;</button>
  <a href="index.php">Home</a>
  <a href="services.php">Plans & Services</a>
  <a href="achievement.php">Achievements</a>
  <a href="about.php">About Us</a>
  <a href="contact.php">Contact Us</a>
  <?php if ($isLoggedIn): ?>
    <a href="recharge.php">Recharge Plans</a>
    <a href="profile.php">Profile</a>
  <?php else: ?>
    <a href="login.php">Account</a>
  <?php endif; ?>
</div>

  <!-- Header -->
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
  <?php if ($isLoggedIn): ?>
    <li><a href="recharge.php">Recharge Plans</a></li>
    <li><a href="profile.php">Profile</a></li>
  <?php else: ?>
    <li><a href="login.php">Account</a></li>
  <?php endif; ?>
</ul>

      </nav>
    </div>
  </header>

  <!-- Banner Slider -->
  <section class="slider">
    <button class="arrow left" id="prev">&#10094;</button>
    <div class="slides" id="slides">
      <img src="images/banner0.png" alt="Banner 1" class="slide-img" />
      <img src="images/banner3.png" alt="Banner 2" class="slide-img" />
      <img src="images/Screenshot 2025-06-25 123503.png" alt="Banner 3" class="slide-img" />
      <img src="images/banner2.png" alt="Banner 4" class="slide-img" />
    </div>
    <button class="arrow right" id="next">&#10095;</button>
  </section>

 <!-- Plans Section -->
  <section class="plans">
<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);


// Database connection
$host = "crossover.proxy.rlwy.net";
$port = 32488;
$username = "root";
$password = "OHtebhVoTYDpgZgrVwjtJJnBDnAUGScb";
$database = "railway";

$conn = new mysqli($host, $username, $password, $database, $port);

// Check connection
if ($conn->connect_error) {
    die("❌ Connection failed: " . $conn->connect_error);
}
?>

<h2>Plans</h2>
<div class="plan-buttons">
<?php
// Fetch data from category table
$sql = "SELECT category_name, image_url, link_url FROM category";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $name = htmlspecialchars($row['category_name']);
        $img = htmlspecialchars($row['image_url']);
        $link = $row['link_url'] ? htmlspecialchars($row['link_url']) : "#";

        echo "<div class='plan-card' onclick=\"location.href='$link'\">
                <img src='$img' alt='$name' class='plan-icon' />
                <p>$name</p>
              </div>";
    }
} else {
    echo "<p>No categories found.</p>";
}

?>
</div>
</section>
<!-- Current Plans Display -->
<section class="current-plans" style="padding: 30px;">
<?php
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $query = "SELECT ur.*, p.plan_name, p.price, p.validity 
              FROM user_recharges ur 
              JOIN plans p ON ur.plan_id = p.id 
              WHERE ur.user_id = '$user_id'";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        echo '<p style="color:red;">Query Failed: ' . mysqli_error($conn) . '</p>';
    } else {
        if (mysqli_num_rows($result) > 0) {
            // Separate plans into active and expired
            $activePlans = [];
            $expiredPlans = [];
            $today = date('Y-m-d');
            
            while ($row = mysqli_fetch_assoc($result)) {
                $expiry = $row['expiry_date'];
                $row['days_left'] = floor((strtotime($expiry) - strtotime($today)) / (60 * 60 * 24));
                
                if ($expiry >= $today) {
                    $activePlans[] = $row;
                } else {
                    $expiredPlans[] = $row;
                }
            }
            
            echo '<div class="tabs">';
            echo '<button class="tab-button active" data-tab="active">Active Plans</button>';
            echo '<button class="tab-button" data-tab="expired">Expired Plans</button>';
            echo '</div>';
            
            // Active Plans Tab
            echo '<div id="active-tab" class="tab-content active">';
            if (!empty($activePlans)) {
                echo '<div class="current-plans-list">';
                foreach ($activePlans as $plan) {
                    echo '<div class="plan-card">';
                    echo '<p><strong>Plan:</strong> ' . htmlspecialchars($plan['plan_name']) . '</p>';
                    echo '<p><strong>Price:</strong> ₹' . number_format($plan['price'], 2) . '</p>';
                    echo '<p><strong>Validity:</strong> ' . htmlspecialchars($plan['validity']) . '</p>';
                    echo '<p><strong>Expiry:</strong> ' . htmlspecialchars($plan['expiry_date']) . '</p>';
                    
                    if ($plan['days_left'] <= 7) {
                        echo '<a href="#" class="renew-button">Renew Now</a>';
                    }
                    
                    echo '</div>';
                }
                echo '</div>';
            } else {
                echo '<p>No active plans found.</p>';
            }
            echo '</div>';
            
            // Expired Plans Tab
            echo '<div id="expired-tab" class="tab-content">';
            if (!empty($expiredPlans)) {
                echo '<div class="current-plans-list">';
                foreach ($expiredPlans as $plan) {
                    echo '<div class="plan-card">';
                    echo '<p><strong>Plan:</strong> ' . htmlspecialchars($plan['plan_name']) . '</p>';
                    echo '<p><strong>Price:</strong> ₹' . number_format($plan['price'], 2) . '</p>';
                    echo '<p><strong>Validity:</strong> ' . htmlspecialchars($plan['validity']) . '</p>';
                    echo '<p><strong>Expired:</strong> ' . htmlspecialchars($plan['expiry_date']) . '</p>';
                    echo '<a href="#" class="renew-button">Renew Now</a>';
                    echo '</div>';
                }
                echo '</div>';
            } else {
                echo '<p>No expired plans found.</p>';
            }
            echo '</div>';
        }
    }
} else {
    echo '<p>Please <a href="signup.php">log in</a> to view your current plans.</p>';
}
?>
</section>

  <!-- Footer -->
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

  <!-- Profile Dialog -->
<div id="profileModal" style="display:none; position:fixed; top:0; left:0; width:100vw; height:100vh; background:rgba(16,29,66,0.25); z-index:2000; align-items:center; justify-content:center;">
    <div style="background:#fff; border-radius:16px; box-shadow:0 8px 32px rgba(16,29,66,0.18); width:95vw; max-width:500px; padding:0; position:relative; display:flex; flex-direction:column; align-items:center;">
        <button onclick="closeProfileModal()" style="position:absolute; top:10px; right:18px; background:none; border:none; font-size:2rem; color:#e10000; cursor:pointer; z-index:10;">&times;</button>
        <iframe id="profileFrame" src="" style="border:none; width:100%; height:600px; border-radius:16px;"></iframe>
    </div>
</div>

<!-- Login Modal -->
<div id="loginModal" style="display:none; position:fixed; top:0; left:0; width:100vw; height:100vh; background:rgba(16,29,66,0.25); z-index:2000; align-items:center; justify-content:center;">
  <div style="background:#fff; border-radius:16px; box-shadow:0 8px 32px rgba(16,29,66,0.18); width:95vw; max-width:400px; padding:0; position:relative; display:flex; flex-direction:column; align-items:center;">
    <button onclick="closeLoginModal()" style="position:absolute; top:10px; right:18px; background:none; border:none; font-size:2rem; color:#e10000; cursor:pointer; z-index:10;">&times;</button>
    <iframe id="loginFrame" src="login.php" style="border:none; width:100%; height:540px; border-radius:16px;"></iframe>
  </div>
</div>

  <script>
     // Slider functionality
    const slides = document.getElementById('slides');
    const images = document.querySelectorAll('.slide-img');
    const totalSlides = images.length;
    let index = 0;

    function showSlide(i) {
      slides.style.transform = `translateX(-${i * 100}%)`;
    }

    function nextSlide() {
      index = (index + 1) % totalSlides;
      showSlide(index);
    }

    function prevSlide() {
      index = (index - 1 + totalSlides) % totalSlides;
      showSlide(index);
    }

    document.getElementById('next').onclick = () => {
      nextSlide();
      resetInterval();
    };
    document.getElementById('prev').onclick = () => {
      prevSlide();
      resetInterval();
    };

    function resetInterval() {
      clearInterval(interval);
      interval = setInterval(nextSlide, 5000);
    }

    showSlide(index); // <-- Make sure this is called before setInterval
    let interval = setInterval(nextSlide, 5000);

    // Responsive image fit
    images.forEach(img => {
      img.onload = () => {
        img.style.objectFit = 'contain';
      };
    });

    // Sidebar toggle
    function toggleSidebar() {
      document.getElementById('sidebar').classList.toggle('active');
    }

    // Current plans tab functionality

    document.addEventListener('DOMContentLoaded', function() {
      const tabButtons = document.querySelectorAll('.tab-button');
      
      tabButtons.forEach(button => {
        button.addEventListener('click', () => {
          // Remove active class from all buttons
          tabButtons.forEach(btn => btn.classList.remove('active'));
          
          // Add active class to clicked button
          button.classList.add('active');
          
          // Hide all tab content
          document.querySelectorAll('.tab-content').forEach(content => {
            content.classList.remove('active');
          });
          
          // Show selected tab content
          const tabId = button.getAttribute('data-tab') + '-tab';
          document.getElementById(tabId).classList.add('active');
        });
      });
    });

    document.querySelectorAll('.renew-button').forEach(button => {
      button.addEventListener('click', function(e) {
        e.preventDefault();
        alert('Redirecting to recharge page...');
        //window.location.href = 'recharge.php';
      });
    });
    // Add this to your main page's JavaScript
window.addEventListener('message', function(event) {
    if (event.data.action === 'loginSuccess') {
        // Close the login modal
        closeLoginModal();
        
        // Redirect to main page
        window.location.href = event.data.redirectUrl;
    }
});

    // Open signup modal
    document.querySelectorAll('a[href="signup.php"]').forEach(function(link) {
      link.addEventListener('click', function(e) {
        e.preventDefault();
        document.getElementById('signupModal').style.display = 'flex';
        document.getElementById('signupFrame').src = 'signup.php';
      });
    });

    function closeSignupModal() {
      document.getElementById('signupModal').style.display = 'none';
      document.getElementById('signupFrame').src = '';
    }

    // Open login modal
document.querySelectorAll('a[href="login.php"]').forEach(function(link) {
  link.addEventListener('click', function(e) {
    e.preventDefault();
    document.getElementById('loginModal').style.display = 'flex';
    document.getElementById('loginFrame').src = 'login.php';
  });
});

function closeLoginModal() {
  document.getElementById('loginModal').style.display = 'none';
  document.getElementById('loginFrame').src = '';
}

    // Open profile modal
document.querySelectorAll('a[href="profile.php"]').forEach(function(link) {
    link.addEventListener('click', function(e) {
        e.preventDefault();
        document.getElementById('profileModal').style.display = 'flex';
        document.getElementById('profileFrame').src = 'profile.php';
    });
});

function closeProfileModal() {
    document.getElementById('profileModal').style.display = 'none';
    document.getElementById('profileFrame').src = '';
}
  </script>
</body>
</html>
