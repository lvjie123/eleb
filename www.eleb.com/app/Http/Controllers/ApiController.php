<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Menu;
use App\Models\Menu_categorie;
use App\Models\Shop;
use App\Models\shop_categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;
use Qcloud\Sms\SmsSingleSender;


class ApiController extends Controller
{
    //
    public function businessList(Request $request)
    {
        $keyword = $request->keyword;
        if($keyword){
            return Shop::where('status','=','1')->where('shop_name','like',"%$keyword%")->get();
        }

        return Shop::where('status','=','1')->get();

    }

    public function business(Request $request)
    {
        $id = $request->id;
        $shop = Shop::find($id);
        $commodity = Menu_categorie::where('shop_id','=',$id)->get();
        foreach ($commodity as $a){
            $a['goods_list'] =  Menu::where('category_id','=',$a->id)->get();
        }
        $shop['commodity'] = $commodity;
        return $shop;
    }

    public function sms(Request $request)
    {
        $appid = 1400189767; // 1400开头

// 短信应用SDK AppKey
        $appkey = "821321ca2ecdfb2544e824961e2e1856";

// 需要发送短信的手机号码
        $phoneNumber = $request->tel;
//templateId7839对应的内容是"您的验证码是: {1}"
// 短信模板ID，需要在短信应用中申请
        $templateId = 285147;  // NOTE: 这里的模板ID`7839`只是一个示例，真实的模板ID需要在短信控制台中申请

        $smsSign = "腾讯云"; // NOTE: 这里的签名只是示例，请使用真实的已申请的签名，签名参数使用的是`签名内容`，而不是`签名ID`

        try {
            $ssender = new SmsSingleSender($appid, $appkey);
            $params = [rand(1000,9999),5];//数组具体的元素个数和模板中变量个数必须一致，例如事例中 templateId:5678对应一个变量，参数数组中元素个数也必须是一个
            $result = $ssender->sendWithParam("86", $phoneNumber, $templateId,
                $params, $smsSign, "", "");  // 签名参数未提供或者为空时，会使用默认签名发送短信
//            $rsp = json_decode($result);
//            echo $result;
        } catch(\Exception $e) {
            echo var_dump($e);
        }
        Redis::setex($phoneNumber,300,$params[0]);
    }

    public function regist(Request $request)
    {
        if(empty(Member::where('username','=',$request->username)->get())){$shop = [ "status"=> "false",
            "message"=> "用户名已存在"];
            return $shop;}
        if(empty(Member::where('tel','=',$request->tel)->get())){$shop = [ "status"=> "false",
            "message"=> "该手机号已被注册"];
            return $shop;}
            if($request->sms != Redis::get($request->tel)){
                $shop = [ "status"=> "false",
                            "message"=> "验证码不正确"];
                return $shop;
            }
        Member::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'tel' => $request->tel,
            'rememberToken' => uniqid(),
        ]);
        $shop = [ "status"=> "true",
            "message"=> "注册成功"];
        return $shop;
    }

    public function loginCheck(Request $request)
    {
        if(Auth::attempt([
            'username'=>$request->name,
            'password'=>$request->password,
        ])){
            $shop=[
                "status"=>"true",
                "message"=>"登录成功",
                "user_id"=>Auth::user()->id,
                "username"=>Auth::user()->username];
            Redis::del(Auth::user()->tel);
        }else{
            $shop=[
                "status"=>"false",
                "message"=>"登录失败，账号或密码不正确"];
        }
        return $shop;
    }
    
}
