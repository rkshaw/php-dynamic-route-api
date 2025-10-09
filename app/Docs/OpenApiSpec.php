<?php declare(strict_types=1);

/**
 * @license Apache 2.0
 */

namespace App\Docs;

use OpenApi\Annotations as OA;

/**
 * @OA\OpenApi(
 *     @OA\Info(
 *         title="My Sample API",
 *         version="1.0.0",
 *         description="Release date: Tuesday, Sep 30, 2025 6:28:25 PM<br/><br/><h2>Overview</h2><ul><li><p><code>Element ID</code> specifies the code of the entity record.</p></li><li><p><strong>Date</strong> follows the <strong><a rel='noopener noreferrer' target='_blank' href='https://en.wikipedia.org/wiki/ISO_8601'>ISO 8601</a></strong> standard, meaning the format <code>YYYY-MM-DD</code>.</p></li><li><p><strong>DateTime</strong> follows the <strong><a rel='noopener noreferrer' target='_blank' href='https://en.wikipedia.org/wiki/ISO_8601'>ISO 8601</a></strong> standard, meaning the format <code>YYYY-MM-DDThh:mm:ss</code>.</p></li></ul><h2>Fields</h2><p>Use the <code>fields</code> parameter to specify which fields should be returned. <code>*</code> means all fields for that resource. If nothing is specified, then only basic fields will be returned.</p><ul><li><code>project,name,units</code> returns <code>{project:..., name:...., units:...}</code>.</li><li><code>project</code> returns <code>'project' : { 'id': 12345, 'url': 'https://google.com/' }</code>.</li></ul><h2>Sorting</h2><p>Use the <code>sorting</code> parameter to specify sorting. It takes a comma separated list, where a <code>-</code> prefix denotes descending. You can sort by sub object with the following format: <code>&lt;field&gt;.&lt;subObjectField&gt;</code>. Example values:</p><ul><li><code>date</code></li><li><code>project.name</code></li><li><code>project.name, -date</code></li></ul><h2>Response envelope</h2><h4>Multiple values</h4><pre></pre><code class='language-json'>{'count': ###, 'values': [...{...object...},{...object...},{...object...}...]}</code><h4>Single value</h4><code>{'value': {...single object...}}</code><h2>Error/warning envelope</h2><code class='language-json'>{'status': ###, 'code': ###, 'message': ###, 'developerMessage': ###}</code><h2>Status codes / Error codes</h2><ul><li><strong>200 OK</strong></li><li><strong>401 Unauthorized</strong> - When authentication is required and has failed or has not yet been provided</li><li><strong>404 Not Found</strong> - For resources that does not exist.</li><li><strong>422 Bad Request</strong> - For Required fields or things like malformed payload</li><li><strong>500 Internal Error</strong> - Unexpected condition was encountered and no more specific message is suitable</li></ul>",
 *         termsOfService="https://your-website.com/terms",
 *         @OA\Contact(
 *             name="Contact us",
 *             url="https://your-website.com",
 *             email="contact@your-website.com"
 *         ),
 *         @OA\License(
 *             name="Sample License",
 *             url="https://your-website.com/license"
 *         )
 *     ),
 *     security={{"bearerAuth":{}}}
 * )
 * @OA\Get(
 *     path="/swagger.php",
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
class OpenApiSpec
{
}
