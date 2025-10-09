<?php
namespace App\Controllers;
use App\Services\Database;
use App\Middleware\AuthMiddleware;
use PDO;

class ProductController {
    /**
     * @OA\Get(
     *     path="/public/api/product",
     *     tags={"Product"},
     *     summary="To get list of all products",
     *     description="Returns collection of products",
     *     operationId="productsGetAll",
     *     @OA\Response(
     *         response=200,
     *         description="Successful response",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Product")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Invalid credentials",
     *         @OA\JsonContent(ref="#/components/schemas/AuthenticationFailed")
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
    public function index() {
        AuthMiddleware::check();
        $db = Database::getConnection();
        $stmt = $db->query('SELECT * FROM product');
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($rows as &$r) {
            $r['is_available'] = (bool)$r['is_available'];
        }
        return ['products' => $rows];
    }

    /**
     * @OA\Get(
     *     path="/public/api/product/{id}",
     *     tags={"Product"},
     *     summary="Get a product",
     *     description="Returns a product",
     *     operationId="productGetById",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="The ID of the product to retrieve",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful response",
     *         @OA\JsonContent(ref="#/components/schemas/Product")
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Invalid credentials",
     *         @OA\JsonContent(ref="#/components/schemas/AuthenticationFailed")
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
    public function show(int $id) {
        AuthMiddleware::check();
        $db = Database::getConnection();
        $stmt = $db->prepare('SELECT * FROM product WHERE id=?');
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $row['is_available'] = (bool) $row['is_available'];
        }
        if (!$row) { http_response_code(404); return ['error'=>'Not found']; }
        return $row;
    }

    /**
     * @OA\Post(
     *     path="/public/api/product",
     *     tags={"Product"},
     *     summary="Add a product",
     *     description="Adds a new product",
     *     operationId="productAddNew",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Product")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful response",
     *         @OA\JsonContent(ref="#/components/schemas/Success")
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Invalid credentials",
     *         @OA\JsonContent(ref="#/components/schemas/AuthenticationFailed")
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Invalid Input",
     *         @OA\JsonContent(ref="#/components/schemas/ValidationFailed")
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server error",
     *         @OA\JsonContent(ref="#/components/schemas/ErrorMessage")
     *     )
     * )
     */
    public function create(array $data) {
        AuthMiddleware::check();
        $db = Database::getConnection();
        $stmt = $db->prepare('INSERT INTO product (name,size,is_available) VALUES (?,?,?)');
        $stmt->execute([$data['name'],$data['size'],$data['is_available']]);
        return ['status'=>'created','id'=>$db->lastInsertId()];
    }

    /**
     * @OA\Put(
     *     path="/public/api/product/{id}",
     *     tags={"Product"},
     *     summary="Modify a product",
     *     description="Updates a product",
     *     operationId="productUpdateById",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="The ID of the product to retrieve",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Product")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful response",
     *         @OA\JsonContent(ref="#/components/schemas/Success")
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Invalid credentials",
     *         @OA\JsonContent(ref="#/components/schemas/AuthenticationFailed")
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Invalid Input",
     *         @OA\JsonContent(ref="#/components/schemas/ValidationFailed")
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server error",
     *         @OA\JsonContent(ref="#/components/schemas/ErrorMessage")
     *     )
     * )
     */
    public function update(int $id, array $data) {
        AuthMiddleware::check();
        $db = Database::getConnection();
        $stmt = $db->prepare('UPDATE product SET name=?,size=?,is_available=? WHERE id=?');
        $stmt->execute([$data['name'],$data['size'],$data['is_available'],$id]);
        return ['status'=>'updated'];
    }

    /**
     * @OA\Delete(
     *     path="/public/api/product/{id}",
     *     tags={"Product"},
     *     summary="Delete a product",
     *     description="Returns a product",
     *     operationId="productDeleteById",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="The ID of the product to retrieve",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful response",
     *         @OA\JsonContent(ref="#/components/schemas/Success")
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Invalid credentials",
     *         @OA\JsonContent(ref="#/components/schemas/AuthenticationFailed")
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
    public function delete(int $id) {
        AuthMiddleware::check();
        $db = Database::getConnection();
        $stmt = $db->prepare('DELETE FROM product WHERE id=?');
        $stmt->execute([$id]);
        return ['status'=>'deleted'];
    }

    /*
    // custom business logic example
    public function processProductForSales(array $payload) {
        AuthMiddleware::check();
        // dummy processing logic
        return ['processed'=>true, 'payload'=>$payload];
    }
    */
}
