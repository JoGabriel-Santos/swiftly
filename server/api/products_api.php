<?php

    const GET_METHOD = 'GET';
    const POST_METHOD = 'POST';
    const DELETE_METHOD = 'DELETE';

    if (!isset($method)) {
        header('HTTP/1.1 405 Method Not Allowed');
        header('Allow: ' . GET_METHOD . ', ' . POST_METHOD . ', ' . DELETE_METHOD);
        exit;
    }

    switch ($method) {
        case GET_METHOD:
            $result = Product::listProducts();
            echo json_encode(["result" => $result]);

            break;

        case POST_METHOD:
            extract(json_decode(file_get_contents("php://input"), true));

            $result = null;

            if (isset($size)) {
                $newProduct = new DVD($sku, $name, $price, $size);
                $result = DVD::addProduct($newProduct);

            } elseif (isset($weight)) {
                $newProduct = new Book($sku, $name, $price, $weight);
                $result = Book::addProduct($newProduct);

            } elseif (isset($dimensions)) {
                $newProduct = new Furniture($sku, $name, $price, $dimensions);
                $result = Furniture::addProduct($newProduct);
            }

            echo json_encode(["result" => $result]);
            break;

        case DELETE_METHOD:
            if (isset($params)) {
                // $result = Product::deleteProduct($params);
                echo json_encode(["result" => $params]);
            }

            break;

        default:
            header('HTTP/1.1 405 Method Not Allowed');
            header('Allow: ' . GET_METHOD . ', ' . POST_METHOD . ', ' . DELETE_METHOD);
            exit;
    }
