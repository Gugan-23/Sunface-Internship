<?php
include "db_connect.php";

$success = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name     = $conn->real_escape_string(trim($_POST['name']));
    $mobile   = $conn->real_escape_string(trim($_POST['mobile']));
    $location = $conn->real_escape_string(trim($_POST['location']));
    $email    = $conn->real_escape_string(trim($_POST['email']));

    if (!preg_match('/^[6-9]\d{9}$/', $mobile)) {
        $error = "Invalid mobile number format.";
    } else {
        $checkDuplicate = "SELECT id FROM contact WHERE email='$email' AND email != '' LIMIT 1";
        $res = $conn->query($checkDuplicate);

        if ($res->num_rows > 0) {
            $error = "This email already exists. Please use another.";
        } else {
            $sql = "INSERT INTO contact (name, mobile, location, email)
                    VALUES ('$name', '$mobile', '$location', '$email')";

            if ($conn->query($sql) === TRUE) {
                $success = "Thank you! We'll get in touch soon.";
            } else {
                $error = "Database error. Please try again.";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Contact Us</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="css/contact.css" />

</head>
<body>

<?php include 'header.php'; ?>

<div class="container">
  <div class="info-box">
    <div class="info-card"><i class="fas fa-map-marker-alt"></i><h3>Address</h3><p>16/31, S&S Enclave, Kannapiran Colony, Valipalayam, Tirupur – 641601</p></div>
    <div class="info-card"><i class="fas fa-envelope"></i><h3>Email</h3><p>info@sunface.in</p></div>
    <div class="info-card"><i class="fas fa-headset"></i><h3>Phone</h3><p>+91 98947 48800</p></div>
    <div class="info-card"><i class="fas fa-phone-square"></i><h3>Land Line</h3><p>0421 2221115</p></div>
  </div>

  <div class="form-box">
    <h2>Get in Touch</h2>
    <form method="POST" action="">
      <input type="text" name="name" placeholder="Name *" required />
      <input type="text" name="mobile" placeholder="Mobile No. *" maxlength="10" required />
      <input type="text" name="location" placeholder="Location *" required />
      <input type="email" name="email" placeholder="Email (optional)" />
      <button type="submit">Send Enquiry</button>
    </form>
  </div>
</div>

<!-- Google Map -->
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3914.811996186839!2d77.3463215141772!3d11.115110692080257!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ba90fd80f34fc11%3A0x81fc0015292bb820!2sSunface%20Software%20Solutions!5e0!3m2!1sen!2sin!4v1687320000000!5m2!1sen!2sin" allowfullscreen="" loading="lazy"></iframe>

<!-- Chat Options -->
<div class="chat-options">
  <div class="chat-box"><i class="fab fa-whatsapp"></i><h3>WhatsApp Chat</h3><a href="https://wa.me/919894748800" target="_blank">Click here to Chat in WhatsApp</a></div>
  <div class="chat-box"><i class="fas fa-comments"></i><h3>Live Chat</h3><a href="#">Use Live Chat in Sidebar</a></div>
  <div class="chat-box"><i class="fab fa-facebook-messenger"></i><h3>Facebook Chat</h3><a href="https://m.me/sunfacesoftwaresolutions" target="_blank">Message on Facebook</a></div>
</div>
<?php include 'footer.php'; ?>

<?php if ($success): ?>
<script>
  Swal.fire({ icon: 'success', title: 'Success', text: '<?= $success ?>' });
</script>
<?php elseif ($error): ?>
<script>
  Swal.fire({ icon: 'error', title: 'Error', text: '<?= $error ?>' });
</script>
<?php endif; ?>

<!-- Font Awesome -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

</body>
</html>