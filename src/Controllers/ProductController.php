<?php

class ProductController {
    public function getProducts(){
        header("HTTP/1.1 200 OK");
        return json_encode([
            ["name" => "Laptop", "price" => 1500],
            ["name" => "Mouse", "price" => 25],
            ["name" => "Keyboard", "price" => 50],
        ]);
    }
    public function postProducts(){
        $body = json_decode(file_get_contents('php://input'));
        // Handle invalid json
        if (json_last_error() !== JSON_ERROR_NONE){
            header("HTTP/1.1 400 Bad Request");
            return json_encode(["message" => "Unexpected body"]);
        }
        // Save product
        $product = [
            "name" => $body->name ?? null,
            "price" => $body->price ?? null,
        ];
        header("HTTP/1.1 200 OK");
        return json_encode(["message" => "Success"]);
    }
    public function getProductById(string $id){
        // Handle invalid product id
        if (!isset($id) || strlen($id) <= 0){
            header("HTTP/1.1 404 Not Found");
            return json_encode([]);
        }
        // Return product
        header("HTTP/1.1 200 OK");
        return json_encode([
            ["id" => $id, "name" => "Laptop", "price" => 1500]
        ]);
    }
}