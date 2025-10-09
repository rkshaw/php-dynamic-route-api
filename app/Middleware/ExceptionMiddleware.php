<?php
namespace App\Middleware;

class ExceptionMiddleware {
    public static function handle(\Closure $next) {
        try {
            return $next();
        } catch (\Exception $e) {
            http_response_code($e->getCode() ?: 500);
            echo json_encode(['error'=>$e->getMessage(),'code'=>$e->getCode()]);
            exit;
        }
    }
}
