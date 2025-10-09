<?php declare(strict_types=1);

/**
 * @license Apache 2.0
 */

namespace App\Models;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="AuthenticationFailed",
 *     type="object",
 *     title="AuthenticationFailed",
 *     required={"message"},
 *     @OA\Property(property="code", type="int", example="401"),
 *     @OA\Property(property="message", type="string", example="Invalid Authentication Token"),
 * )
 */

class AuthenticationFailed {
    public int $code;
    public string $message;
}
