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
            $product_list = Product::listProducts();

            break;

        case POST_METHOD:
            // TODO

            break;

        case DELETE_METHOD:
            // TODO

            break;

        default:
            header('HTTP/1.1 405 Method Not Allowed');
            header('Allow: ' . GET_METHOD . ', ' . POST_METHOD . ', ' . DELETE_METHOD);
            exit;
    }
