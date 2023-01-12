<?php

class Product{
    public $id;
    public $title;
    public $price;
    public $img_url;


    public function __construct($title, $price, $img_url, $id = 0)
    {
        if($id > 0){
            $this->id = $id;
        }

        $this->title = $title;
        $this->price = $price;
        $this->img_url = $img_url;
    }
}