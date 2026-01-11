<?php
require_once __DIR__ . '/controllers/EmployeeController.php';

header("Content-Type: application/json");

/*
|--------------------------------------------------------------------------
| Clean Request URI
|--------------------------------------------------------------------------
*/
$uri = $_SERVER['REQUEST_URI'];
$uri = urldecode($uri);                      // remove %0A etc
$uri = parse_url($uri, PHP_URL_PATH);        // remove query string
$method = $_SERVER['REQUEST_METHOD'];

$controller = new EmployeeController();

/*
|--------------------------------------------------------------------------
| ROUTES
|--------------------------------------------------------------------------
*/

// ADD EMPLOYEE  (POST)
if ($method === 'POST' && strpos($uri, '/api/employee') !== false) {
    $controller->create();
    exit;
}

// GET EMPLOYEE BY ID
if ($method === 'GET' && preg_match('#/api/employee/(\d+)#', $uri, $matches)) {
    $controller->getById($matches[1]);
    exit;
}

// GET ALL EMPLOYEES
if ($method === 'GET' && strpos($uri, '/api/employees') !== false) {
    $controller->getAll();
    exit;
}



// UPDATE EMPLOYEE
// UPDATE EMPLOYEE
if ($method === 'PUT' && preg_match('#/api/employee/(\d+)#', $uri, $matches)) {
    $controller->update($matches[1]);
    exit;
}

// DELETE EMPLOYEE
if ($method === 'DELETE' && preg_match('#/api/employee/(\d+)#', $uri, $matches)) {
    $controller->delete($matches[1]);
    exit;
}



/*
|--------------------------------------------------------------------------
| DEFAULT RESPONSE
|--------------------------------------------------------------------------
*/
echo json_encode([
    "message" => "Welcome to Employee API",
    "uri" => $uri,
    "method" => $method
]);
