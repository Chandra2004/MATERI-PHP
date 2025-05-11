<?php
    session_start();
    if (isset($_SESSION['found']) == true) {
        header("Location: http://localhost/materi-php/CRUD-json%2011-05-2025/dashboard");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Register</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
        }
        .container {
            width: 300px;
            padding: 20px;
            background: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        input {
            margin-bottom: 15px;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            padding: 10px;
            font-size: 16px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        .toggle-link {
            text-align: center;
            margin-top: 10px;
        }
        .toggle-link a {
            color: #007bff;
            text-decoration: none;
        }
        .toggle-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container" id="login-container">
        <h2>Login</h2>
        <?php if (isset($_SESSION['alert'])): ?>
            <div style="color: red; font-weight: bold;">
                <?= $_SESSION['alert'] ?>
            </div>
        <?php endif; ?>
        <?php unset($_SESSION['alert']); ?>

        <form action="login/login_process.php" method="POST">
            <input type="text" name="identifier" placeholder="Username / Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="loginUser">Login</button>
        </form>
        <div class="toggle-link">
            <p>Don't have an account? <a href="#" onclick="toggleForm('register')">Register</a></p>
        </div>
    </div>

    <div class="container" id="register-container" style="display: none;">
        <h2>Register</h2>
        <form action="register/register_process.php" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="registerUser">Register</button>
        </form>
        <div class="toggle-link">
            <p>Already have an account? <a href="#" onclick="toggleForm('login')">Login</a></p>
        </div>
    </div>

    <script>
        function toggleForm(form) {
            const loginContainer = document.getElementById('login-container');
            const registerContainer = document.getElementById('register-container');
            if (form === 'login') {
                loginContainer.style.display = 'block';
                registerContainer.style.display = 'none';
            } else {
                loginContainer.style.display = 'none';
                registerContainer.style.display = 'block';
            }
        }
    </script>
</body>
</html>