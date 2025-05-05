
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Logging Out...</title>
  <meta http-equiv="refresh" content="2;url=login.php?logged_out=1">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">

  <style>
  
  html, body {
  background-color: #eafaf1;
  margin: 0;
  padding: 0;
  overflow: hidden; /* ✅ Hide scrollbar */
  height: 100%;
  font-family: 'Poppins', sans-serif;
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
}


    .leaf {
      font-size: 80px;
      animation: spin 1s linear infinite;
    }

    .message {
      margin-top: 20px;
      font-size: 22px;
      color: #2d6a4f;
    }

    @keyframes spin {
      from { transform: rotate(0deg); }
      to { transform: rotate(360deg); }
    }
  </style>
</head>
<body>
  <div class="leaf">🍃</div>
  <div class="message">Logging you out...</div>
</body>
</html>

