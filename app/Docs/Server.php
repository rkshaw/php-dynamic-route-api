<?php declare(strict_types=1);

/**
 * @license Apache 2.0
 */

namespace App\Docs;

use OpenApi\Annotations as OA;

/**
 * @OA\Server(
 *     url="{scheme}://localhost/php-api-psr4",
 *     description="Dynamic scheme",
 *     @OA\ServerVariable(
 *         serverVariable="scheme",
 *         enum={"https", "http"},
 *         default="http"
 *     )
 * )
 * @OA\Server(
 *     url="{scheme}://127.0.0.1/php-api-psr4",
 *     description="Dynamic scheme",
 *     @OA\ServerVariable(
 *         serverVariable="scheme",
 *         enum={"https", "http"},
 *         default="http"
 *     )
 * )
 */
class Server
{
}
