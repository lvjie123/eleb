<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use App\Models\Order_detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TongjiController extends Controller
{
    //
    public function index()
    {
        $datas = [];
        $datass = [];
        for ($i = 0;$i <= 6;$i++){
            $k = date('Y-m-d',strtotime("-$i day"));
            $j = Order::where('created_at','like',"$k%")->count();
            $datas[$k] = $j;
        }
        for ($i = 0;$i <= 2;$i++){
            $k = date('Y-m',strtotime("-$i month"));
            $j = Order::where('created_at','like',"$k%")->count();
            $datass[$k] = $j;
        }
        return view('tongji.day',['datas'=>$datas,'datass'=>$datass]);
    }

    public function caipin()
    {
        $shop_id = Auth::user()->shop_id;
        $time_start = date('Y-m-d 00:00:00',strtotime('-6 day'));
        $time_end = date('Y-m-d 23:59:59');
        $sql = "SELECT
	DATE(orders.created_at) AS date,order_details.goods_id,
	SUM(order_details.amount) AS total
FROM
	order_details
JOIN orders ON order_details.order_id = orders.id
WHERE
	 orders.created_at >= '{$time_start}' AND orders.created_at <= '{$time_end}'
AND shop_id = {$shop_id}
GROUP BY
	DATE(orders.created_at),order_details.goods_id";

        $rows = DB::select($sql);

        $result = [];
        //获取当前商家的菜品列表
        $menus = Menu::where('shop_id',$shop_id)->select(['id','goods_name'])->get();
        $keyed = $menus->mapWithKeys(function ($item) {
            return [$item['id'] => $item['goods_name']];
        });
        $keyed2 = $menus->mapWithKeys(function ($item) {
            return [$item['id'] => 0];
        });
        $menus = $keyed->all();
        //dd($menus);
        $week=[];
        for ($i=0;$i<7;$i++){
            $week[] = date('Y-m-d',strtotime("-{$i} day"));
        }
        foreach ($menus as $id=>$name){
            foreach ($week as $day){
                $result[$id][$day] = 0;
            }
        }
        /**/
        //dd($result);
        foreach ($rows as $row){
            $result[$row->goods_id][$row->date]=$row->total;
        }
        //dd($result);
        $series = [];
        foreach ($result as $id=>$data){
            $serie = [
                'name'=> $menus[$id],
                'type'=>'line',
                //'stack'=> '销量',
                'data'=>array_values($data)
            ];
            $series[] = $serie;
        }

        return view('tongji.caipin',compact('result','menus','week','series'));
    }

    public function caipin1()
    {
        $shop_id = Auth::user()->shop_id;
        $time_start = date('Y-m-d 00:00:00',strtotime('-3 month'));
        $time_end = date('Y-m-d 23:59:59');

        $sql = "SELECT
	DATE(orders.created_at) AS date,order_details.goods_id,
	SUM(order_details.amount) AS total
FROM
	order_details
JOIN orders ON order_details.order_id = orders.id
WHERE
	 orders.created_at >= '{$time_start}' AND orders.created_at <= '{$time_end}'
AND shop_id = {$shop_id}
GROUP BY
	DATE(orders.created_at),order_details.goods_id";

        $rows = DB::select($sql);

        $result = [];
        //获取当前商家的菜品列表
        $menus = Menu::where('shop_id',$shop_id)->select(['id','goods_name'])->get();
        $keyed = $menus->mapWithKeys(function ($item) {
            return [$item['id'] => $item['goods_name']];
        });


        $keyed2 = $menus->mapWithKeys(function ($item) {
            return [$item['id'] => 0];
        });
        $menus = $keyed->all();
        //dd($menus);
        $week=[];
        for ($i=0;$i<3;$i++){
            $week[] = date('Y-m',strtotime("-{$i} month"));
        }

        foreach ($menus as $id=>$name){
            foreach ($week as $day){
                $result[$id][$day] = 0;
            }
        }
        /**/
        //dd($result);
        foreach ($rows as $row){
            $time = strtotime($row->date);
            $dater = date('Y-m',$time);
            $result[$row->goods_id][$dater]=$row->total;
        }
        //dd($result);
        $series = [];
        foreach ($result as $id=>$data){
            $serie = [
                'name'=> $menus[$id],
                'type'=>'line',
                //'stack'=> '销量',
                'data'=>array_values($data)
            ];
            $series[] = $serie;
        }

        return view('tongji.caipin1',compact('result','menus','week','series'));
    }
}
