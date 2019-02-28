<?php
header("Access-Control-Allow-Origin: *");
echo <<<JSON
    {
      "status": "true",
      "message": "支付成功"
    }
JSON;
