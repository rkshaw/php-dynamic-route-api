<?php
namespace App\Services;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Exception;

class JwtService {
    private string $secret;
    private string $algo;
    private int $ttl;

    public function __construct() {
        $cfg = include __DIR__ . '/../Config/config.php';
        $this->secret = $cfg['jwt']['secret'];
        $this->algo = $cfg['jwt']['algo'];
        $this->ttl = $cfg['jwt']['ttl'];
    }

    public function generateToken(array $claims, ?int $expirySeconds = null): string {
        $now = time();
        $exp = $now + ($expirySeconds ?? $this->ttl);
        $payload = array_merge($claims, ['iat'=>$now,'exp'=>$exp]);
        return JWT::encode($payload, $this->secret, $this->algo);
    }

    public function validateToken(string $token): object {
        try {
            return JWT::decode($token, new Key($this->secret, $this->algo));
        } catch (\Firebase\JWT\ExpiredException $e) {
            throw new Exception('Token expired', 401);
        } catch (Exception $e) {
            throw new Exception('Invalid token', 401);
        }
    }
}
