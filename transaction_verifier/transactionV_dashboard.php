<?php
// Start session only if none is active
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Prevent browser from caching the page
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// Check if the user is logged in and their account type matches
if (!isset($_SESSION['user_id']) || $_SESSION['account_type'] !== 'transaction verifier') {
    header("Location: /login.php"); // Redirect to login page
    exit();
}

// Variables for display
$current_page = basename($_SERVER['PHP_SELF'], ".php");
$account_type = ucfirst(htmlspecialchars($_SESSION['account_type']));
$name = htmlspecialchars($_SESSION['name']);
$success = "";
$error = "";

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <script type="text/javascript">
        window.history.forward();
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Business Partner Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html, body {
            font-family: 'Poppins', sans-serif;
            height: 100%;
            padding: 5px;
        }

        .some-page-wrapper {
            display: flex;
            flex-direction: column;
            height: 100%;
            background-color: red;
            border-radius: 20px;
            overflow: hidden;
            gap: 10px;
        }

        .top-section {
            flex: 0 0 25%;
            background-color: green;
            position: relative;
            border-radius: 15px;
        }

        .greeting-wrapper {
            position: absolute;
            bottom: 20px;
            left: 20px;
            display: flex;
            gap: 10px;
            align-items: baseline;
            z-index: 1;
        }

        .greeting {
            font-size: clamp(40px, 10vw, 100px);
            font-weight: 800;
            color: #2c3e50;
        }

        .account-info {
            font-size: clamp(20px, 4vw, 30px);
            font-weight: 600;
            color: #34495e;
        }

        .main-content {
            flex: 1;
            background-color: purple;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 20px;
            border-radius: 15px;
        }

        .user-info-square {
            width: 40px;
            height: 40px;
            background-color: #007bff;
            color: white;
            font-size: 24px;
            text-align: center;
            line-height: 40px;
            border-radius: 8px;
            cursor: pointer;
            position: absolute;
            top: 10px;
            right: 10px;
            transition: background-color 0.3s ease;
            z-index: 2;
        }

        .user-info-square:hover {
            background-color: #0056b3;
        }

        .user-info {
            background-color: #fff;
            color: #333;
            padding: 10px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            position: absolute;
            top: 50px;
            right: 0;
            width: 200px;
            display: none;
            z-index: 3;
        }

        .user-info p {
            margin: 5px 0;
        }

        .user-info a {
            display: block;
            margin-top: 10px;
            text-decoration: none;
            color: #007bff;
        }

        .user-info a:hover {
            color: #0056b3;
        }
    </style>
    <script>
        function toggleUserInfo() {
            var userInfo = document.querySelector('.user-info');
            if (userInfo.style.display === 'none' || userInfo.style.display === '') {
                userInfo.style.display = 'block';
            } else {
                userInfo.style.display = 'none';
            }
        }
    </script>
</head>
<body>
    <div class="some-page-wrapper">
        <div class="top-section">
            <div class="user-info-wrapper">
                <div class="user-info-square" onclick="toggleUserInfo()">&#x1F464;</div>
                <div class="user-info" style="display: none;">
                    <p><strong>User Name:</strong> <?php echo $name; ?></p>
                    <p><strong>User Type:</strong> <?php echo $account_type; ?></p>
                    <a href="#" onclick="toggleChangePasswordForm()">Change Password</a>
                    <a href="../logout.php">Logout</a>
                </div>
            </div>
</div>
    
            <div class="greeting-wrapper">
                <span class="greeting">Hello,</span>
                <span class="account-info"><?php echo $account_type . ' ' . $name; ?></span>
            </div>
        </div>
        <div class="main-content">
            <div>
                <h1>Welcome to the Trasnsaction Verifier Dashboard</h1>
                <p>Here, you can manage all the different aspects of the business!</p>
            </div>
        </div>
    </div>
</body>
</html>
