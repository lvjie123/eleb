<?php
header("Access-Control-Allow-Origin: *");
/**
 * tel: 手机号
 * sms: 短信验证码
 * password: 密码
 */
echo <<<JSON
    {
      "status": "true",
      "message": "添加成功"
    }
JSON;
