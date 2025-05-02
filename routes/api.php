<?php
use Controller\UserController;
header("Content-Type: application/json");

$method = $_SERVER['REQUEST_METHOD'];
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
error_log("Request Method: $method, URI: $uri");

$userController = new UserController();

switch ($method) {
    case 'POST':
        if ($uri === '/login') {
            $userController->login($_POST);
        } elseif ($uri === '/dashboard.php/api/logout') {
            $userController->logout();
        } elseif ($uri === '/register') {
            $userController->register($_POST);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Route not found']);
        }
        break;
    default:
        http_response_code(405);
        echo json_encode(['error' => 'Method not allowed']);
        break;
}