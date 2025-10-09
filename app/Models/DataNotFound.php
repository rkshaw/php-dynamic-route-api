<?php declare(strict_types=1);

/**
 * @license Apache 2.0
 */

namespace App\Models;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="DataNotFound",
 *     type="object",
 *     title="DataNotFound",
 *     required={"message"},
 *     @OA\Property(property="code", type="int", example=404),
 *     @OA\Property(property="message", type="string", example="Record not found"),
 * )
 */

class DataNotFound {
    public int $code;
    public string $message;
}
