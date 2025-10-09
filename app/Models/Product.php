<?php declare(strict_types=1);

/**
 * @license Apache 2.0
 */

namespace App\Models;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="Product",
 *     type="object",
 *     title="Product",
 *     required={"name", "size", "is_available"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="Product name"),
 *     @OA\Property(property="size", type="integer", example=1),
 *     @OA\Property(property="is_available", type="boolean", example=true)
 * )
 */

class Product {
    public int $id;
    public string $name;
    public int $size;
    public bool $is_available;
}
