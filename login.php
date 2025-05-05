<?php

session_start();  // Start the session to store user data after login

// Connect to your database
$mysqli = new mysqli('localhost', 'root', '', 'AHV1_db');
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $mysqli->prepare("SELECT id, email, password, account_type, name FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $db_email, $db_password, $account_type, $name);
        $stmt->fetch();

        if (password_verify($password, $db_password)) {
            $_SESSION['user_id'] = $id;
            $_SESSION['email'] = $db_email;
            $_SESSION['account_type'] = $account_type;
            $_SESSION['name'] = $name; // ✅ Now saving name too

            switch ($account_type) {
                case 'farmer':
                    header("Location: farmer/farmer_dashboard.php");
                    break;
                case 'business partner':
                    header("Location: business_partner/businessP_dashboard.php");
                    break;
                case 'transaction verifier':
                    header("Location: transaction_verifier/transactionV_dashboard.php");
                    break;
                case 'business owner':
                    header("Location: business_owner/businessO_dashboard.php");
                    break;
            }
            exit();
        } else {
            echo "Invalid password!";
        }
    } else {
        echo "No user found with that email!";
    }

    $stmt->close();
    $mysqli->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <style>
  * {
    box-sizing: border-box;
  }

  body {
    margin: 0;
    font-family: Arial, sans-serif;
    background: url('images/bg.jpg') no-repeat center center fixed;
    background-size: cover;
    display: flex;
    height: 100vh;
  }

  .wrapper {
    display: flex;
    width: 100%;
  }

  .left-image, .login-container {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .left-image img {
    max-width: 80%;
    max-height: 80%;
    border-radius: 10px;
  }

  .login-box {
    width: 100%;
    max-width: 500px; /* still responsive width */
    min-height: 600px; /* add a minimum height to make it tall */
    padding: 50px;
    background: rgba(255, 255, 255, 0.95);
    border-radius: 10px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
    display: flex;
    flex-direction: column;
    justify-content: center; /* center the form vertically */
}



  h1 {
    text-align: center;
    margin-bottom: 20px;
    color: #333;
  }

  label {
    display: block;
    margin-top: 15px;
    color: #555;
  }

  input {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    border-radius: 4px;
    border: 1px solid #ccc;
    background-color: #f9f9f9;
  }

  input:focus {
    border-color: #28a745;
    outline: none;
  }

  .button-container {
    margin-top: 20px;
    display: flex;
    gap: 10px;
  }

  button, .register-btn {
    flex: 1;
    padding: 10px;
    border: none;
    border-radius: 4px;
    font-weight: bold;
    cursor: pointer;
    text-align: center;
    text-decoration: none;
  }

  button {
    background: #28a745;
    color: white;
  }

  button:hover {
    background: #218838;
  }

  .register-btn {
    background: #007bff;
    color: white;
  }

  .register-btn:hover {
    background: #0056b3;
  }
  .password-wrapper {
  position: relative;
  display: flex;
  align-items: center;
}

.password-wrapper input {
  flex: 1;
}

.password-wrapper .eye {
  position: absolute;
  right: 10px;
  cursor: pointer;
  font-size: 20px;
  color: #555;
}


  @media (max-width: 768px) {
  .wrapper {
    flex-direction: column;
    align-items: center;
    justify-content: center;
  }

  .left-image, .login-container {
    flex: none;
    width: 100%;
    max-width: 90%;
    margin: 20px 0;
  }

  .left-image img {
    max-width: 60%;
    height: auto;
  }

  .login-box {
    width: 100%;
    max-width: 90%;
    padding: 30px;
    min-height: 500px; /* shorter height on small screens */
}


  input, button, .register-btn {
    font-size: 16px; /* bigger touch-friendly size */
    padding: 12px; /* bigger padding for easier tapping */
  }

  label {
    font-size: 14px; /* adjust labels slightly smaller */
  }

  h1 {
    font-size: 24px; /* title smaller on mobile */
  }

  .button-container {
    flex-direction: column;
    align-items: center;
  }

  .button-container button, 
  .button-container .register-btn {
    width: 100%;
    margin: 5px 0;
  }
}


</style>



</head>
<body>
  <div class="wrapper">
    <!-- Left Side: Image -->
    <div class="left-image">
      <img src="images/AniHanda.svg" alt="Your side image">
    </div>

    <!-- Right Side: Login Form -->
    <div class="login-container">
      <div class="login-box">
        <h1>Login</h1>
        <form action="login.php" method="post">
          <label for="email">Email:</label>
          <input type="email" id="email" name="email" required>

          <label for="password">Password:</label>
            <div class="password-wrapper">
            <input type="password" id="password" name="password" required>
            <span id="togglePassword" class="eye">&#128065;</span> <!-- 👁 Unicode eye icon -->
          </div>

          <!-- Button Container -->
          <div class="button-container">
          <button type="submit">Login</button>
          <a href="register.php" class="register-btn">Register</a>

</div>

        </form>
      </div>
    </div>
  </div>

</body>


</html>


<script>
const togglePassword = document.getElementById('togglePassword');
const passwordField = document.getElementById('password');

togglePassword.addEventListener('click', function () {
  const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
  passwordField.setAttribute('type', type);
  this.textContent = type === 'password' ? '👁️' : '🙈';
});

// Logout back-button block
<?php if ($showLogoutScript): ?>
  if (window.history && window.history.pushState) {
      window.history.pushState({}, document.title, window.location.href);
      window.history.back();
      window.history.forward();
  }
<?php endif; ?>
</script>
