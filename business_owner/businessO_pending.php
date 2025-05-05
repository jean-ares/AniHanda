<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
if (!isset($_SESSION['user_id']) || $_SESSION['account_type'] !== 'business owner') {
  header("Location: login.php");
  exit();  
}

$current_page = basename($_SERVER['PHP_SELF'], ".php");
$account_type = ucfirst(htmlspecialchars($_SESSION['account_type']));
$name = htmlspecialchars($_SESSION['name']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Owner Dashboard</title>
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
      overflow: hidden;
      padding: 5px;

    }

    

    .some-page-wrapper {
    display: flex;
    flex-direction: column;
    height: 100%;
    background-color: red;
    border-radius: 20px;
    overflow: hidden;
    gap: 10px; /* 👈 Adds spacing between all direct children (top-section and row) */
    }



    .top-section {
      flex: 0 0 25%;
      background-color: green;
      position: relative;
      border-radius: 15px;  /* Curves all corners */

    }

    .greeting-wrapper {
      position: absolute;
      bottom: 20px;
      left: 20px;
      display: flex;
      gap: 10px;
      align-items: baseline;
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


    .row {
      flex: 1;
      display: flex;
      width: 100%;
      margin-top: 10px; 
      gap: 20px;
    }

    .left-column {
      flex: 0.3;
      background-color: blue;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      align-items: center;
      color: white;
      font-size: 20px;
      min-height: 50px;
      border-radius: 15px;  /* Curves all corners */
    }

    .left-column a {
      display: inline-block;
      padding: 30px 40px;
      font-size: clamp(16px, 2vw, 22px);
      background-color: #007bff;
      color: white;
      border-radius: 8px;
      width: 90%;
      max-width: 320px;
      text-align: center;
      text-decoration: none;
      transition: background-color 0.3s ease, transform 0.2s ease;
      margin: 10px auto;
      box-sizing: border-box;
    }

    .left-column a.active {
      background-color: green;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
      font-weight: bold;
    }


    .right-column {
      flex: 0.7;
      background-color: purple;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-size: 20px;
      border-radius: 15px;  /* Curves all corners */

    }

    /* Style the user info square */
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
    right: 10px;  /* Changed from left to right */
    transition: background-color 0.3s ease;
    z-index: 2;  /* Higher z-index to ensure it stays above other elements */
  }

  .user-info-square:hover {
    background-color: #0056b3;
  }

  /* Style the user info dropdown */
  .user-info {
    background-color: #fff;
    color: #333;
    padding: 10px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    position: absolute;
    top: 50px;
    right: 0; /* Ensures the dropdown is aligned to the right */
    width: 200px;
    display: none;
    z-index: 3;  /* Higher z-index to ensure it appears above the greeting */
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

    @media (max-width: 768px) {
      .left-column a {
        padding: 20px 24px;
        font-size: 18px;
      }
    }

    @media (max-width: 480px) {
      .left-column a {
        padding: 16px 20px;
        font-size: 16px;
      }
    }
  </style>

<script>
  function toggleUserInfo() {
    var userInfo = document.querySelector('.user-info');
    // Toggle the visibility of the user-info div
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
        <a href="change_password.php">Change Password</a>
        <a href="../logout.php">Logout</a>
      </div>
      </div>

      <div class="greeting-wrapper">
        <span class="greeting">Hello,</span>
        <span class="account-info"><?php echo $account_type . ' ' . $name; ?></span>
      </div>

    </div>
    
    <div class="row">
    <div class="left-column">
        <a href="businessO_dashboard.php" class="<?php echo ($current_page == 'businessO_dashboard') ? 'active' : ''; ?>">Dashboard</a>
        <a href="businessO_pending.php" class="<?php echo ($current_page == 'businessO_pending') ? 'active' : ''; ?>">Pending</a>
        <a href="businessO_disputes.php" class="<?php echo ($current_page == 'businessO_disputes') ? 'active' : ''; ?>">Disputes</a>
        <a href="businessO_inventory.php" class="<?php echo ($current_page == 'businessO_inventory') ? 'active' : ''; ?>">Inventory</a>
        <a href="businessO_forecasting.php" class="<?php echo ($current_page == 'businessO_forecasting') ? 'active' : ''; ?>">Forecasting</a>
      </div>

      <div class="right-column">
        <div>
          <h1>Welcome to the Owner Dashboard</h1>
          <p>Here, you can manage all the different aspects of the business!</p>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
