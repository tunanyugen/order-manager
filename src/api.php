<?php

include_once "./bootstrap.php";

Route::add(RouteMethod::GET, "/products", ProductController::class, "getProducts");
Route::add(RouteMethod::POST, "/products", ProductController::class, "postProducts");
Route::add(RouteMethod::GET, "/products/test", ProductController::class, "getProducts"); // this route is for testing if /products/{id} could be reached
Route::add(RouteMethod::GET, "/products/{id}", ProductController::class, "getProductById");

Route::process();