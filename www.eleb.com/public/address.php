<?php
header("Access-Control-Allow-Origin: *");
echo <<<JSON
    {
      "id": "2",
     "provence": "河北省",
     "city": "保定市",
     "area": "武侯区",
     "detail_address": "四川省成都市武侯区天府大道56号",
     "name": "张三",
     "tel": "18584675789"
    }
JSON;
