<?php

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

        public static function listProducts()
        {
            $db = new Database(MYSQL_CONFIG);

            // return $db->executeQuery()
        }

        abstract public static function addProduct($productInfo);

        abstract public static function delProduct($productInfo);
    }
