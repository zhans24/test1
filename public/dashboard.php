<?php
require_once __DIR__ . '/../vendor/autoload.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: /index.php');
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
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4">
    <a class="navbar-brand" href="#">MyApp</a>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item"><a class="nav-link active" href="#">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Features</a></li>
            <li class="nav-item"><a class="nav-link" href="#">About</a></li>
        </ul>
        <form class="d-flex">
            <button class="btn btn-outline-danger" id="logout" type="submit">Logout</button>
        </form>
    </div>
</nav>

<!-- Page Content -->
<div class="container mt-5">
    <h1>Welcome to the Dashboard!</h1>
    <p>This is your main area. You can customize this section with your content.</p>
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Section One</h5>
                    <p class="card-text">This is an example of a content section. Add your widgets or info here.</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Section Two</h5>
                    <p class="card-text">You can add graphs, charts, or stats here in future.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="assets/dashboard.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>