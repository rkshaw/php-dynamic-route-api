<?php declare(strict_types=1);

/**
 * @license Apache 2.0
 */

namespace App\Models;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="ErrorMessage",
 *     type="object",
 *     title="ErrorMessage",
 *     required={"message"},
 *     @OA\Property(property="code", type="string", example="DB_SERVER_001"),
 *     @OA\Property(property="file", type="string", example="product-gateway.php"),
 *     @OA\Property(property="line", type="int", example="100"),
 *     @OA\Property(property="message", type="string", example="Couldn't connect to db server")
 * )
 */

class ErrorMessage {
    public string $code;
    public string $file;
    public int $line;
    public string $message;
}
