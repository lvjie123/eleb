<?php
header("Access-Control-Allow-Origin: *");
/**
 * "order_code": 订单号
 * "order_birth_time": 订单创建日期
 * "order_status": 订单状态
 * "shop_id": 商家id
 * "shop_name": 商家名字
 * "shop_img": 商家图片
 * "goods_list": [{//购买商品列表
 * "goods_id": "1"//
 * "goods_name": "汉堡"
 * "goods_img": "/images/slider-pic2.jpeg"
 * "amount": 6
 * "goods_price": 10
 * }]
 */
echo <<<JSON
    [{
        "id": "1",
        "order_code": "0000001",
        "order_birth_time": "2017-02-17 18:36",
        "order_status": "已完成",
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
    },{
        "id": "1",
        "order_code": "0000001",
        "order_birth_time": "2017-02-17 18:36",
        "order_status": "已完成",
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
    }]
JSON;
