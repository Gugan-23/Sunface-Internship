<?php
session_start();
require_once 'db_connect.php';

// Handle login
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM signup WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && ($password === $user['password'] || password_verify($password, $user['password']))) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_mobile'] = $user['mobile'];
        $_SESSION['user_address'] = $user['address'];
        $_SESSION['user_created'] = $user['created'];
        

        $_SESSION['flash'] = [
            'type' => 'success',
            'message' => 'Welcome back, ' . $user['name'] . '!'
        ];
    } else {
        $login_error = "Invalid email or password";
    }

    $stmt->close();
}

// Logout
if (isset($_GET['logout'])) {
    $_SESSION['flash'] = [
        'type' => 'info',
        'message' => 'You have been logged out successfully.'
    ];
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit();
}

// Flash Message
$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

// Plan Data
$currentPlan = null;
$daysUntilExpiry = 0;
$hasActivePlan = false;
$alternatives = [];

if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];

    $stmt = $conn->prepare("
        SELECT p.*, ur.recharge_date, ur.expiry_date 
        FROM user_recharges ur
        JOIN plans p ON ur.plan_id = p.id
        WHERE ur.user_id = ?
        ORDER BY ur.recharge_date DESC
    ");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    $allSubscribedPlans = [];
    while ($row = $result->fetch_assoc()) {
        $allSubscribedPlans[] = $row;
    }
    $stmt->close();

    $currentPlan = $allSubscribedPlans[0] ?? null;
    $category = $currentPlan ? $currentPlan['category'] : 'Website';
    $currentPlanId = $currentPlan ? $currentPlan['id'] : 0;

    $stmt = $conn->prepare("
        SELECT * FROM plans 
        WHERE category = ? AND id != ?
        ORDER BY 
            CASE 
                WHEN validity LIKE '%90%' THEN 1 
                WHEN validity LIKE '%60%' THEN 2 
                ELSE 3 
            END,
            price ASC
        LIMIT 3
    ");
    $stmt->bind_param("si", $category, $currentPlanId);
    $stmt->execute();
    $result = $stmt->get_result();

    $alternatives = [];
    while ($row = $result->fetch_assoc()) {
        $alternatives[] = $row;
    }
    $stmt->close();

    // Expiry
    if (!empty($currentPlan['expiry_date'])) {
        $expiryDate = new DateTime($currentPlan['expiry_date']);
        $today = new DateTime();
        $diff = $today->diff($expiryDate);
        $daysUntilExpiry = $diff->invert ? 0 : $diff->days;
        $hasActivePlan = ($daysUntilExpiry > 0);
    }
}

// Active Tab
$activeTab = $_GET['tab'] ?? 'home';
$validTabs = ['home', 'support'];
if (!in_array($activeTab, $validTabs)) {
    $activeTab = 'home';
}

// Features
$planFeatures = [
    'Website' => [
        'Responsive Design',
        'SEO Optimization',
        'CMS Integration',
        'E-commerce Functionality',
        'Security Features'
    ],
    'Mobile App' => [
        'Native Android/iOS App',
        'Push Notifications',
        'Offline Support',
        'In-App Purchases',
        'Social Media Integration'
    ]
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sunface - Website Development Plans</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="recharge.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
<div class="container">

<?php if ($flash): ?>
    <div class="flash-message <?= $flash['type'] ?>">
        <i class="fas <?= $flash['type'] === 'success' ? 'fa-check-circle' : 'fa-info-circle' ?>"></i>
        <?= $flash['message'] ?>
    </div>
<?php endif; ?>

<?php if (isset($_SESSION['user_id'])): ?>
    <header>
        <div class="logo">
            <img src="images/logo/sunface-logo.png" alt="Sunface Logo" class="logo-img">
            <h1>Website <span>Plans</span></h1>
        </div>
        <div class="user-info">
            <div class="user-avatar"><?= substr($_SESSION['user_name'], 0, 1) ?></div>
            <div>
                <div><?= $_SESSION['user_name'] ?></div>
                <div><?= $_SESSION['user_email'] ?></div>
            </div>
            <a href="?logout" class="btn btn-logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
    </header>

    <div class="dashboard-grid">
                <?php if (!empty($allSubscribedPlans)): ?>
                    <?php foreach ($allSubscribedPlans as $plan): ?>
                        <?php
                        $expiryDate = new DateTime($plan['expiry_date']);
                        $rechargeDate = new DateTime($plan['recharge_date']);
                        $today = new DateTime();
                        $diff = $today->diff($expiryDate);
                        $daysUntilExpiry = $diff->invert ? 0 : $diff->days;
                        $hasActivePlan = $daysUntilExpiry > 0;
                        ?>
                        <div class="card">
                            <div class="card-header">
                                <h2><i class="fas fa-crown"></i> <?= htmlspecialchars($plan['category']) ?> Plan</h2>
                                <div class="status <?= $hasActivePlan ? 'active' : 'expired' ?>">
                                    <?= $hasActivePlan ? 'Active' : 'Expired' ?>
                                </div>
                            </div>
                            <div class="current-plan">
                                <div class="plan-image">
                                    <img src="images/plans/<?= $plan['image'] ?>" alt="<?= htmlspecialchars($plan['plan_name']) ?>">
                                </div>
                                <div class="plan-details">
                                    <h3><?= htmlspecialchars($plan['plan_name']) ?></h3>
                                    <div class="detail-row">
                                        <div class="detail-item"><strong>Price:</strong> ₹<?= number_format($plan['price'], 2) ?></div>
                                        <div class="detail-item"><strong>Validity:</strong> <?= $plan['validity'] ?></div>
                                        <div class="detail-item"><strong>Recharge:</strong> <?= $rechargeDate->format('M d, Y') ?></div>
                                        <div class="detail-item"><strong>Expires:</strong> <?= $expiryDate->format('M d, Y') ?></div>
                                        <div class="detail-item"><strong>Days Left:</strong> <?= $daysUntilExpiry ?> days</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="no-plan">
                        <h3>No active plans</h3>
                        <p>Select a plan to get started</p>
                        <button class="btn btn-primary"><i class="fas fa-search"></i> Browse Plans</button>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Recommendations -->
            <div class="card">
                <div class="card-header"><h2><i class="fas fa-lightbulb"></i> Recommended Plans</h2></div>
                <div class="alternatives-grid">
                    <?php foreach ($alternatives as $plan): ?>
                        <div class="plan-card">
                            <div class="plan-card-header"><?= $plan['plan_name'] ?> - <?= $plan['category'] ?></div>
                            <div class="plan-image"><img src="images/plans/<?= $plan['image'] ?>" alt="<?= $plan['plan_name'] ?>"></div>
                            <div class="plan-price">₹<?= number_format($plan['price'], 2) ?></div>
                            <ul class="plan-features">
                                <?php foreach ($planFeatures[$plan['category']] as $feature): ?>
                                    <li><i class="fas fa-check-circle"></i> <?= $feature ?></li>
                                <?php endforeach; ?>
                            </ul>
                            <div class="plan-card-footer">
                                <button class="btn btn-primary"><i class="fas fa-bolt"></i> Recharge Now</button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

    <!-- Notification -->
    <?php if (!$hasActivePlan): ?>
        <div class="notification danger">
            <i class="fas fa-exclamation-triangle"></i> Your plan has expired! Renew now.
        </div>
    <?php elseif ($daysUntilExpiry <= 7): ?>
        <div class="notification warning">
            <i class="fas fa-exclamation-triangle"></i> Plan expires in <?= $daysUntilExpiry ?> days! Renew soon.
        </div>
    <?php endif; ?>

<?php else: ?>
    <!-- Login View -->
    <header>
        <div class="logo">
            <img src="images/logo/sunface-logo.png" alt="Sunface Logo" class="logo-img">
            <h1>Website <span>Plans</span></h1>
        </div>
    </header>
    <!-- Add login form here if needed -->
<?php endif; ?>
</div>

<script src="recharge_script.js"></script>
</body>
</html>
