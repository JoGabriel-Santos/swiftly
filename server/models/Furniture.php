<?php

    class Furniture extends Product
    {
        protected $dimensions;

        public function __construct($sku, $name, $price, $dimensions)
        {
            parent::__construct($sku, $name, $price);
            $this->dimensions = $dimensions;
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
