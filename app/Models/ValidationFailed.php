<?php declare(strict_types=1);

/**
 * @license Apache 2.0
 */

namespace App\Models;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="ValidationFailed",
 *     type="object",
 *     title="ValidationFailed",
 *     required={"errors"},
 *     @OA\Property(property="code", type="int", example=422),
 *     @OA\Property(
 *         property="errors",
 *         type="array",
 *         @OA\Items(type="string"),
 *         example={"name is required", "id must not provide"}
 *     )
 * )
 */

class ValidationFailed {
    public int $code;
    
    /** @var string[] */
    public array $errors;
}
