<?php

    require_once __DIR__ . '/../connection/config.php';

    use sys4soft\Database;

    class Furniture extends Product
    {
        protected $dimensions;

        public function __construct($sku, $name, $price, $dimensions)
        {
            parent::__construct($sku, $name, $price);
            $this->dimensions = $dimensions;
        }

        public static function addProduct($productInfo): stdClass
        {
            $db = new Database(MYSQL_CONFIG);

            $params = [
                ':sku' => $productInfo->getSku(),
                ':name' => $productInfo->getName(),
                ':price' => $productInfo->getPrice(),
                ':dimensions' => $productInfo->getDimensions()
            ];

            return $db->executeNonQuery(
                "INSERT INTO product_form (sku, name, price, dimensions) VALUES (:sku, :name, :price, :dimensions)", $params
            );
        }

        public function getDimensions()
        {
            return $this->dimensions;
        }
    }
