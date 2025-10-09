<?php
namespace App\Middleware;
use App\Services\JwtService;

class AuthMiddleware {
    public static function check(): object {
        $headers = function_exists('getallheaders') ? getallheaders() : [];
        $auth = $headers['Authorization'] ?? $headers['authorization'] ?? null;
        if (!$auth) {
            http_response_code(401);
            echo json_encode(['code'=> 401, 'message'=>'Authorization header missing']);
            exit;
        }
        if (!preg_match('/Bearer\\s(\\S+)/', $auth, $m)) {
            http_response_code(401);
            echo json_encode(['code'=> 401, 'message'=>'Invalid Authorization header format']);
            exit;
        }
        $token = $m[1];
        $svc = new JwtService();
        try {
            return $svc->validateToken($token);
        } catch (\Exception $e) {
            http_response_code($e->getCode() ?: 401);
            echo json_encode(['code'=> 401, 'message'=>$e->getMessage()]);
            exit;
        }
    }
}
