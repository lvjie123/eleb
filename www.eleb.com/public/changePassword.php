<?php
header("Access-Control-Allow-Origin: *");
/**
 * oldPassword: 旧密码
 * newPassword: 新密码
 */
echo <<<JSON
    {
      "status": "true",
      "message": "修改成功"
    }
JSON;
