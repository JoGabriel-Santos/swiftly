<?php

    require_once __DIR__ . '/../connection/config.php';

    use sys4soft\Database;

    abstract class Product
    {
        protected $sku;
        protected $name;
        protected $price;

        public function __construct($sku, $name, $price)
        {
            $this->sku = $sku;
            $this->name = $name;
            $this->price = $price;
        }

        abstract public static function addProduct($productInfo);

        public static function listProducts(): stdClass
        {
            $db = new Database(MYSQL_CONFIG);

            return $db->executeQuery("SELECT * FROM product_form");
        }

        public static function deleteProduct($productInfo): stdClass
        {
            $db = new Database(MYSQL_CONFIG);

            $params = [
                ':sku' => $productInfo,
            ];

            return $db->executeNonQuery("DELETE FROM product_form WHERE SKU = :sku", $params);
        }

        public function getSku()
        {
            return $this->sku;
        }

        public function getName()
        {
            return $this->name;
        }

        public function getPrice()
        {
            return $this->price;
        }
    }
