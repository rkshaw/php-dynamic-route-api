<?php
declare(strict_types=1);
require __DIR__ . '/../vendor/autoload.php';
use App\Middleware\ExceptionMiddleware;

header('Content-Type: application/json');

$uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
$method = $_SERVER['REQUEST_METHOD'];

$response = ExceptionMiddleware::handle(function() use ($uri, $method) {
    $parts = explode('/', $uri);
    // Expecting /{base}/api/{controller}/{id_or_action?}
    // find 'api' segment
    $apiIndex = array_search('api', $parts);
    if ($apiIndex === false || !isset($parts[$apiIndex+1])) {
        http_response_code(404);
        return ['error' => 'Invalid route'];
    }
    $controllerSegment = $parts[$apiIndex+1];
    $controllerName = ucfirst($controllerSegment) . 'Controller';
    $controllerClass = 'App\\Controllers\\' . $controllerName;
    if (!class_exists($controllerClass)) {
        http_response_code(404);
        return ['error' => "Controller $controllerName not found"];
    }
    $controller = new $controllerClass();
    $next = $parts[$apiIndex+2] ?? null;
    $data = json_decode(file_get_contents('php://input'), true) ?? [];

    // CRUD mapping
    if ($method === 'GET' && $next === null) {
        return $controller->index();
    }
    if ($method === 'GET' && is_numeric($next)) {
        return $controller->show((int)$next);
    }
    if ($method === 'POST' && $next === null) {
        return $controller->create($data);
    }
    if ($method === 'PUT' && is_numeric($next)) {
        return $controller->update((int)$next, $data);
    }
    if ($method === 'DELETE' && is_numeric($next)) {
        return $controller->delete((int)$next);
    }
    // Custom action: /api/{controller}/{action}
    if ($next !== null && method_exists($controller, $next)) {
        return $controller->{$next}($data);
    }
    http_response_code(404);
    return ['error' => 'Route not found'];
});

echo json_encode($response);
