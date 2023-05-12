<?php

    class DVD extends Product
    {
        protected $size;

        public function __construct($sku, $name, $price, $size)
        {
            parent::__construct($sku, $name, $price);
            $this->size = $size;
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
