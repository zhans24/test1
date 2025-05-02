<?php
require_once __DIR__ . '/../vendor/autoload.php';


session_start();
if (isset($_SESSION['user_id'])) {
    header("Location:/dashboard.php");
    exit;
}
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if ($_SERVER['REQUEST_METHOD'] === 'POST' || str_starts_with($requestUri, '/api/')) {
    require __DIR__ . '/../routes/api.php';
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Sign Up</title>
    <link rel="stylesheet" href="assets/styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
<div class="container">
    <div class="form-container">
        <div class="form-box login">
            <h2>Sign In</h2>
            <form id="sign-in-form">
                <label>Email</label>

                <div class="input-box">

                    <input type="email" name="email" required>
                </div>
                <label>Password</label>

                <div class="input-box">
                    <input type="password" name="password" required>
                </div>
                <button type="submit" class="btn">Login</button>
                <div class="signup-link">
                    Don't have an account? <a href="#" class="toggle">Sign Up</a>
                </div>
            </form>
        </div>

        <div class="form-box signup">
            <h2>Sign Up</h2>
            <form id="sign-up-form">
                <label>Username</label>

                <div class="input-box">
                    <input type="text" name="username" required>
                </div>
                <label>Email</label>

                <div class="input-box">
                    <input type="email" name="email" required>
                </div>
                <label>Password</label>

                <div class="input-box">
                    <input type="password" name="password" required>
                </div>
                <button type="submit" class="btn">Create Account</button>
                <div class="signup-link">
                    Already have an account? <a href="#" class="toggle">Login</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="assets/auth.js"></script>
</body>
</html>