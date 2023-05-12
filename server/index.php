<?php

// Set CORS headers
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type, Authorization");

// Set default timezone
    date_default_timezone_set("America/Sao_Paulo");

// Parse request path
    if (!isset($_GET['path'])) {
        http_response_code(400);

        echo "Bad request: path parameter missing";
        exit;
    }

    $path = explode("/", $_GET['path']);

    if (count($path) < 2) {
        http_response_code(400);

        echo "Bad request: invalid path format";
        exit;
    }

// Extract API and action from path
    $api = $path[0];
    $action = $path[1];

// Extract params from path, if any
    $params = "";
    if (count($path) > 2) {
        $params = $path[2];
    }

// Determine request method
    $method = $_SERVER['REQUEST_METHOD'];

    require "models/Book.php";
    require "models/DVD.php";
    require "models/Furniture.php";
    require "models/Product.php";

    require_once "connection/Database.php";
    require_once "api/products_api.php";