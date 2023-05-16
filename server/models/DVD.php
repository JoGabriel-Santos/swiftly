<?php

    require_once __DIR__ . '/../connection/config.php';

    use sys4soft\Database;

    class DVD extends Product
    {
        protected $size;

        public function __construct($sku, $name, $price, $size)
        {
            parent::__construct($sku, $name, $price);
            $this->size = $size;
        }

        public static function addProduct($productInfo): stdClass
        {
            $db = new Database(MYSQL_CONFIG);

            $params = [
                ':sku' => $productInfo->getSku(),
                ':name' => $productInfo->getName(),
                ':price' => $productInfo->getPrice(),
                ':size' => $productInfo->getSize()
            ];

            return $db->executeNonQuery(
                "INSERT INTO product_form (sku, name, price, size) VALUES (:sku, :name, :price, :size)", $params
            );
        }

        public function getSize()
        {
            return $this->size;
        }
    }
