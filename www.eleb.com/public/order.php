<?php
header("Access-Control-Allow-Origin: *");
/**
 * id:订单id
 */
echo <<<JSON
    {
        "id": "1",
        "order_code": "0000001",
        "order_birth_time": "2017-02-17 18:36",
        "order_status": "代付款",
        "shop_id": "1",
        "shop_name": "上沙麦当劳",
        "shop_img": "/images/shop-logo.png",
        "goods_list": [{
            "goods_id": "1",
            "goods_name": "汉堡",
            "goods_img": "/images/slider-pic2.jpeg",
            "amount": 6,
            "goods_price": 10
        }, {
            "goods_id": "1",
            "goods_name": "汉堡",
            "goods_img": "/images/slider-pic2.jpeg",
            "amount": 6,
            "goods_price": 10
        }],
        "order_price": 120,
        "order_address": "北京市朝阳区霄云路50号 距离市中心约7378米北京市朝阳区霄云路50号 距离市中心约7378米"
    }
JSON;
