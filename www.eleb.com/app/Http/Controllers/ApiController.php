<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Cart;
use App\Models\Member;
use App\Models\Menu;
use App\Models\Menu_categorie;
use App\Models\Order;
use App\Models\Order_detail;
use App\Models\Shop;
use App\Models\shop_categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;
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
            foreach( $a['goods_list'] as $c){
                $c['goods_id'] = $c->id;
            }
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

    public function addressList()
    {
        $address = Address::where('user_id','=',\auth()->user()->id)->get();
        foreach($address as $a){
            $a['area'] = $a->county;
            $a['provence'] = $a->province;
            $a['detail_address'] = $a->address;
        }
        return $address;
    }

    public function addAddress(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'tel'=>'required',
            'provence'=>'required',
            'city'=>'required',
            'area'=>'required',
            'detail_address'=>'required',
        ],[
            'name.required'=>'收货人不能为空',
            'tel.required'=>'联系方式不能为空',
            'provence.required'=>'省不能为空',
            'city.required'=>'市不能为空',
            'area.required'=>'区不能为空',
            'detail_address.required'=>'详细地址不能为空',
        ]);
        Address::create([
            'name' => $request->name,
            'tel' => $request->tel,
            'province' => $request->provence,
            'city' => $request->city,
            'county' => $request->area,
            'address' => $request->detail_address,
            'user_id' => \auth()->user()->id,
            'is_default' => 0,
        ]);
        $address = ["status"=> "true",
                    "message"=> "添加成功"];
        return $address;
    }

    public function address(Request $request)
    {
        $address = Address::find($request->id);
        $address['area'] = $address->county;
        $address['provence'] = $address->province;
        $address['detail_address'] = $address->address;
        return $address;
    }

    public function editAddress(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'tel'=>'required',
            'provence'=>'required',
            'city'=>'required',
            'area'=>'required',
            'detail_address'=>'required',
        ],[
            'name.required'=>'收货人不能为空',
            'tel.required'=>'联系方式不能为空',
            'provence.required'=>'省不能为空',
            'city.required'=>'市不能为空',
            'area.required'=>'区不能为空',
            'detail_address.required'=>'详细地址不能为空',
        ]);

        $address = Address::find($request->id);
        $address->update([
            'name' => $request->name,
            'tel' => $request->tel,
            'province' => $request->provence,
            'city' => $request->city,
            'county' => $request->area,
            'address' => $request->detail_address,
        ]);

        $address = ["status"=> "true",
                    "message"=> "修改成功"];
        return $address;

    }

    public function addCart(Request $request)
    {
        $goodsList = $request->goodsList;
        $goodsCount = $request->goodsCount;
        for($i=0;$i<count($goodsList);$i++){
            Cart::create([
                'user_id'=>\auth()->user()->id,
                'goods_id' => $goodsList[$i],
                'amount' => $goodsCount[$i]
            ]);
        }
        $addcart = ["status"=> "true",
                    "message"=> "添加成功"];
        return $addcart;
    }

    public function cart()
    {
        $cart = Cart::where('user_id','=',\auth()->user()->id)->get();
        $totalCost = 0;
        $s = [];
        foreach ($cart as $a){
            $c = Menu::find($a->goods_id);
            $totalCost += $c['goods_price']*$a['amount'];
            $c['amount'] = $a['amount'];
            $s[]= $c;
        }
        $data['goods_list'] = $s;
        $data['totalCost'] = $totalCost;
        return $data;
    }

    public function addorder(Request $request)
    {
        $id = $request->address_id;
        if(isset($id)){
            $totalCost = 0;
            $cart = Cart::where('user_id','=',\auth()->user()->id)->get();
            $address = Address::find($id);
            $shops = Cart::where('user_id','=',\auth()->user()->id)->first();
            $goods_id = $shops->goods_id;
            $shopsss = Menu::where('id','=',$goods_id)->first();
            $shop_id = $shopsss->shop_id;
            $order_id = '';
            foreach ($cart as $a){
                $c = Menu::find($a->goods_id);
                $totalCost += $c['goods_price']*$a['amount'];
            }
            DB::transaction(function ()use($shop_id,$address,$totalCost,&$order_id,$cart) {
                $order=Order::create([
                    'user_id'=>\auth()->user()->id,
                    'shop_id'=>$shop_id,
                    'sn'=>date('Y-m-d').mt_rand(1000,9999),
                    'province'=>$address->province,
                    'city'=>$address->city,
                    'county'=>$address->county,
                    'address'=>$address->address,
                    'tel'=>$address->tel,
                    'name'=>$address->name,
                    'total'=>$totalCost,
                    'status'=>0,
                    'out_trade_no'=>uniqid(),
                ]);
                $order_id = $order->id;
                foreach ($cart as $c) {
                    $good = Menu::find($c->goods_id);
                    $data_goods = [
                        'order_id' => $order_id,
                        'goods_id' => $c->goods_id,
                        'amount' => $c->amount,
                        'goods_name' => $good->goods_name,
                        'goods_img' => $good->goods_img,
                        'goods_price' => $good->goods_price,
                    ];
                    Order_detail::create($data_goods);
                }
            });
            $addorder = ["status"=> "true",
                "message"=> "添加成功",
                "order_id"=>$order_id];
            return $addorder;
        }else{
            $addorder = ["status"=> "false",
                "message"=> "添加失败",];
            return $addorder;
        }
    }

    public function order(Request $request)
    {
        $order = Order::find($request->id);
        $shop = Shop::find($order->shop_id);
        $order_details = Order_detail::where('order_id','=',$order->id)->get();
        if($order->starts==-1){
            $c = '已取消';
        }elseif($order->starts==0){
            $c = '待支付';
        }elseif($order->starts==1){
            $c = '待发货';
        }elseif($order->starts==2){
            $c = '待确认';
        }elseif($order->starts==3){
            $c = '完成';
        }
        $aa = ['id'=>$order->id,
                'order_code'=>$order->sn,
                'order_birth_time'=>$order->created_at->toArray()['formatted'],
                'order_status'=>$c,
                'shop_id'=>$order->shop_id,
                'shop_name'=>$shop->shop_name,
                'shop_img'=>$shop->shop_img,
                'goods_list'=>$order_details,
                'order_price'=>$order->total,
                'order_address'=>$order->address
        ];
        return $aa;
    }

    public function orderList()
    {
        $orders = Order::where('user_id','=',9)->get();
        $ss = [];
        foreach ($orders as $order){
            $shop = Shop::find($order->shop_id);
            $order_details = Order_detail::where('order_id','=',$order->id)->get();
            if($order->starts==-1){
                $c = '已取消';
            }elseif($order->starts==0){
                $c = '待支付';
            }elseif($order->starts==1){
                $c = '待发货';
            }elseif($order->starts==2){
                $c = '待确认';
            }elseif($order->starts==3){
                $c = '完成';
            }
            $aa = ['id'=>$order->id,
                'order_code'=>$order->sn,
                'order_birth_time'=>$order->created_at->toArray()['formatted'],
                'order_status'=>$c,
                'shop_id'=>$order->shop_id,
                'shop_name'=>$shop->shop_name,
                'shop_img'=>$shop->shop_img,
                'goods_list'=>$order_details,
                'order_price'=>$order->total,
                'order_address'=>$order->address
            ];
            $ss[] = $aa;
            }
        return $ss;
        }

    public function changePassword(Request $request)
    {
        $this->validate($request,[
            'oldPassword'=>'required',
            'newPassword'=>'required',//confirmed 要求new_password字段值和new_password_confirmation一致
        ]);
        $member = Auth::user();
        if(!Hash::check($request->oldPassword,$member->password)){
            return ["status"=> "false",
                "message"=> "修改失败",];
        }
        $member->update(['password'=>Hash::make($request->newPassword)]);
        $change = ["status"=> "true",
                    "message"=> "修改成功",];
        return $change;
        }

    public function forgetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tel' => 'required|numeric|digits_between:11,11',
            'sms' => 'required',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return [
                "status"=> "false",
                "message"=> implode(' ',$validator->errors()->all()),
            ];
        }
        if ($request->sms == Redis::get($request->tel)) {
            Member::where('tel','=',$request->tel)->update(['password'=>Hash::make($request->password)]);
            return [
                "status"=>"true",
                "message"=>"重置成功"
            ];
        }else{
            return [
                "status"=>"false",
                "message"=>"验证码错误"
            ];
        }

    }


}
