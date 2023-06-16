<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Product;
use App\Models\User;

class OrderController extends Controller
{
        
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('is_admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::paginate(10);
        return view('admin.orders.list')->with('orders',$orders);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();
        $users = User::all();
        return view('admin.orders.create',compact('products','users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => ['int','required'],
        ]);
       $data = $request->all();
       $user_id = $data['user_id'];
       $total = $data['total'];
       $order = Order::create(['user_id'=>$user_id,'status'=>'pending','total'=> $total]);
       foreach($data['product_id'] as $key => $product_id){
       
           OrderDetails::create([
               'product_id'=>$product_id,
                'quantity'=>$data['quantity'][$key],
                'order_id'=>$order->id
            ]);
       }
       return redirect()->route('admin.orders.index')
       ->with('success','Order created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        $products = Product::all();
        $users = User::all();
        $order_details = OrderDetails::where('order_id',$order->id)->get();
        // dd($order_details);
        return view('admin.orders.edit',compact('products','order','users','order_details'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        OrderDetails::where('order_id',$order->id)->delete();
        $order->delete();
        return redirect()->route('admin.orders.index')
                        ->with('success','Order deleted successfully');
    }
}
