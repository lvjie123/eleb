<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Order_detail;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function orderlist()
    {
        $user = User::find(Auth::user()->id);
        $shop_id = $user->shop_id;
        $orders = Order::where('shop_id','=',$shop_id)->paginate(3);
        return view('order.index',['orders'=>$orders]);
    }

    public function cancel(Request $request)
    {

        $order = Order::find($request->user);
        $order->status = -1;
        $order->save();
        return redirect()->route('orderlist')->with('success','取消订单成功');
    }

    public function cancel1(Request $request)
    {

        $order = Order::find($request->user);
        $order->status = 2;
        $order->save();
        return redirect()->route('orderlist')->with('success','发货成功');
    }

    public function showorder(Request $request)
    {
        $id = $request->id;
        $orders = Order_detail::where('order_id','=',$id)->paginate(3);
        return view('order.show',['orders'=>$orders]);
    }
}
