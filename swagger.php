<?php
require_once __DIR__ . '/vendor/autoload.php';
use OpenApi\Generator;

/**
 * @OA\Get(
 *     path="/php-api/help/api.php",
 *     summary="JSON for rendering swagger document without authorization",
 *     description="Returns JSON for swagger documentation",
 *     operationId="getSwaggerDocument",
 *     security={},
 *     deprecated=true,
 *     @OA\Response(
 *         response=200,
 *         description="Successful response"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Not found",
 *         @OA\JsonContent(ref="#/components/schemas/DataNotFound")
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Server error",
 *         @OA\JsonContent(ref="#/components/schemas/ErrorMessage")
 *     )
 * )
 */

header('Content-Type: application/json');
echo Generator::scan([__DIR__ . '/app'])->toJson();
