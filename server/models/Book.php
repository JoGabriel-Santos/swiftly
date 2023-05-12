<?php

    class Book extends Product
    {
        protected $weight;

        public function __construct($sku, $name, $price, $weight)
        {
            parent::__construct($sku, $name, $price);
            $this->weight = $weight;
        }

        public static function addProduct($productInfo)
        {
            // TODO: Implement addProduct() method.
        }

        public static function delProduct($productInfo)
        {
            // TODO: Implement delProduct() method.
        }
    }
