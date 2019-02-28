<?php
header("Access-Control-Allow-Origin: *");
/**
 * "id": "s10001",
 * "shop_name": "上沙麦当劳",
 * "shop_img": "/images/shop-logo.png",
 * "shop_rating": 4.7,评分
 * "brand": true,是否是品牌
 * "on_time": true,是否准时送达
 * "fengniao": true,是否蜂鸟配送
 * "bao": true,是否保标记
 * "piao": true,是否票标记
 * "zhun": true,是否准标记
 * "start_send": 20,起送金额
 * "send_cost": 5,配送费
 * "distance": 637,距离
 * "estimate_time": 30,预计时间
 * "notice": "新店开张，优惠大酬宾！",店公告
 * "discount": "新用户有巨额优惠！"优惠信息
 */
echo <<<JSON
    [
      {
        "id": "s10001",
        "shop_name": "上沙麦当劳",
        "shop_img": "/images/shop-logo.png",
        "shop_rating": 4.7,
        "brand": true,
        "on_time": true,
        "fengniao": true,
        "bao": true,
        "piao": true,
        "zhun": true,
        "start_send": 20,
        "send_cost": 5,
        "distance": 637,
        "estimate_time": 30,
        "notice": "新店开张，优惠大酬宾！",
        "discount": "新用户有巨额优惠！"
      },
      {
        "id": "s10002",
        "shop_name": "正宗川味卤鸡蛋，味道好得很！",
        "shop_img": "/images/shop-logo.png",
        "shop_rating": 3.5,
        "brand": false,
        "on_time": true,
        "fengniao": false,
        "bao": true,
        "piao": false,
        "zhun": true,
        "start_send": 20,
        "send_cost": 0,
        "distance": 347,
        "estimate_time": 20,
        "notice": "新店开张，优惠大酬宾！",
        "discount": "新用户有巨额优惠！"
      },
      {
        "id": "s10003",
        "shop_name": "有家蛋糕店（下沙店）",
        "shop_img": "/images/shop-logo.png",
        "shop_rating": 4.4,
        "brand": false,
        "on_time": true,
        "fengniao": false,
        "bao": true,
        "piao": false,
        "zhun": true,
        "start_send": 80,
        "send_cost": 0,
        "distance": 637,
        "estimate_time": 30,
        "notice": "新店开张，优惠大酬宾！",
        "discount": "新用户有巨额优惠！"
      },
      {
        "id": "s10004",
        "shop_name": "宇宙炸鸡（上沙店）",
        "shop_img": "/images/shop-logo.png",
        "shop_rating": 4.3,
        "brand": true,
        "on_time": false,
        "fengniao": false,
        "bao": true,
        "piao": false,
        "zhun": true,
        "start_send": 20,
        "send_cost": 5,
        "distance": 127,
        "estimate_time": 10,
        "notice": "新店开张，优惠大酬宾！",
        "discount": "新用户有巨额优惠！"
      },
      {
        "id": "s10005",
        "shop_name": "胖哥烧烤（车公庙店）",
        "shop_img": "/images/shop-logo.png",
        "shop_rating": 4.6,
        "brand": false,
        "on_time": false,
        "fengniao": false,
        "bao": true,
        "piao": false,
        "zhun": true,
        "start_send": 20,
        "send_cost": 4,
        "distance": 500,
        "estimate_time": 10,
        "notice": "新店开张，优惠大酬宾！",
        "discount": "新用户有巨额优惠！"
      }
    ]
JSON;
