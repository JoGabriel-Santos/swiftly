<?php

    require_once __DIR__ . '/../connection/config.php';

    use sys4soft\Database;

    class Book extends Product
    {
        protected $weight;

        public function __construct($sku, $name, $price, $weight)
        {
            parent::__construct($sku, $name, $price);
            $this->weight = $weight;
        }

        public static function addProduct($productInfo): stdClass
        {
            $db = new Database(MYSQL_CONFIG);

            $params = [
                ':sku' => $productInfo->getSku(),
                ':name' => $productInfo->getName(),
                ':price' => $productInfo->getPrice(),
                ':weight' => $productInfo->getWeight()
            ];

            return $db->executeNonQuery(
                "INSERT INTO product_form (sku, name, price, weight) VALUES (:sku, :name, :price, :weight)", $params
            );
        }

        public function getWeight()
        {
            return $this->weight;
        }
    }
