<?php declare(strict_types=1);

/**
 * @license Apache 2.0
 */

namespace App\Models;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="Success",
 *     type="object",
 *     title="Success",
 *     required={"status"},
 *     @OA\Property(property="status", type="boolean", example=true)
 * )
 */

class Success {
    public bool $status;
}
