<?php

class Json{
    public $id;
    public $productName;
    public $productPrice;
    public $productImg;
    public $productSale;


    public function __construct($productName, $productPrice, $productImg, $productSale, $id = 0)
    {
        if($id > 0){
            $this->id = $id;
        }

        $this->productName = $productName;
        $this->productPrice = $productPrice;
        $this->productImg = $productImg;
        $this->productSale = $productSale;
    }
}