<?php
namespace App\Controllers;
use App\Services\JwtService;

class AuthController {
    // login: POST /api/auth/login
    public function login(array $data) {
        // simple demo auth; replace with DB validation
        $username = $data['username'] ?? '';
        $password = $data['password'] ?? '';
        if ($username === 'admin' && $password === 'secret') {
            $svc = new JwtService();
            $token = $svc->generateToken(['user_id'=>1,'username'=>'admin']);
            return ['access_token'=>$token,'token_type'=>'Bearer'];
        }
        http_response_code(401);
        return ['error'=>'Invalid credentials'];
    }
}
