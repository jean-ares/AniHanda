<?php
// INDEX.PHP
$mysqli = new mysqli('localhost', 'root', '', 'AHV1_db');

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect form data
    $email = $_POST['email'];
    $name = $_POST['name'];
    $password = $_POST['password'];
    $account_type = $_POST['account_type'];

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare and bind SQL statement
    $stmt = $mysqli->prepare("INSERT INTO users (email, name, password, account_type) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $email, $name, $hashed_password, $account_type);

    // Execute the query
    if ($stmt->execute()) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $mysqli->close();
}
?>

<form action="register.php" method="post">
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>

    <label for="name">Full Name:</label>
    <input type="text" id="name" name="name" required>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>

    <label for="account_type">Account Type:</label>
    <select id="account_type" name="account_type">
        <option value="farmer">Farmer</option>
        <option value="business partner">Business Partner</option>
        <option value="transaction verifier">Transaction Verifier</option>
        <option value="business owner">Business Owner</option>
    </select>

    <button type="submit">Register</button>
</form>


<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background: #f4f4f4;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .form-container {
        background: #fff;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 400px;
    }

    h1 {
        text-align: center;
        color: #333;
        margin-bottom: 20px;
    }

    label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
        color: #555;
    }

    input, select, button {
        width: 100%;
        padding: 10px;
        margin: 10px 0;
        border-radius: 4px;
        border: 1px solid #ccc;
    }

    button {
        background-color: #28a745;
        color: white;
        font-weight: bold;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    button:hover {
        background-color: #218838;
    }

    select {
        background-color: #f9f9f9;
    }

    input[type="email"], input[type="text"], input[type="password"] {
        background-color: #f9f9f9;
    }

    input:focus, select:focus, button:focus {
        outline: none;
        border-color: #28a745;
    }
</style>

