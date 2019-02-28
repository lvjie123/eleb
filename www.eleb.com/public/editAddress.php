<?php
header("Access-Control-Allow-Origin: *");
/**
 * id: 地址id,
 * name: 收货人
 * tel: 联系方式
 * provence: 省
 * city: 市
 * area: 区
 * detail_address: 详细地址
 */
echo <<<JSON
    {
      "status": "true",
      "message": "修改成功"
    }
JSON;
