<?php
namespace App\Controllers;
use App\Middleware\AuthMiddleware;

class UserController {
    public function index() {
        AuthMiddleware::check();
        return ['users'=>[['id'=>1,'name'=>'Rahul']]];
    }
    public function show(int $id) {
        return ['id'=>$id,'name'=>'User'.$id];
    }
    public function create(array $data) {
        return ['status'=>'created','data'=>$data];
    }
}
