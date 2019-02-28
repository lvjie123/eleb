<?php
header("Access-Control-Allow-Origin: *");
/**
 * tel:手机号
 */
echo <<<JSON
    {
      "status": "true",
      "message": "获取短信验证码成功"
    }
JSON;
