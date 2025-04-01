<?php

include_once "./bootstrap.php";

Route::add(RouteMethod::GET, "/products", ProductController::class, "getProducts");
Route::add(RouteMethod::POST, "/products", ProductController::class, "postProducts");
Route::add(RouteMethod::GET, "/products/test", ProductController::class, "getProductById");
Route::add(RouteMethod::GET, "/products/{id}", ProductController::class, "getProductById");

Route::process();