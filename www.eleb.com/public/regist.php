<?php
header("Access-Control-Allow-Origin: *");
/**
 * username: 用户名
 * tel: 手机号
 * sms: 短信验证码
 * password: 密码
 */
echo <<<JSON
    {
      "status": "true",
      "message": "注册成功"
    }
JSON;
