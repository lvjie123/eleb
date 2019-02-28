<?php
header("Access-Control-Allow-Origin: *");
/**
 * address_id: 地址id
 */
echo <<<JSON
    {
      "status": "true",
      "message": "添加成功",
      "order_id":1
    }
JSON;
