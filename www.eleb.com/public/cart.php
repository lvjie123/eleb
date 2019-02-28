<?php
header("Access-Control-Allow-Origin: *");
echo <<<JSON
    {
      "goods_list": [{
        "goods_id": "1",
        "goods_name": "汉堡",
        "goods_img": "http://www.homework.com/images/slider-pic2.jpeg",
        "amount": 6,
        "goods_price": 10
      },{
        "goods_id": "1",
        "goods_name": "汉堡",
        "goods_img": "http://www.homework.com/images/slider-pic2.jpeg",
        "amount": 6,
        "goods_price": 10
      }],
     "totalCost": 120
    }
JSON;
