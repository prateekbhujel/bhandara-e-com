<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::latest()->paginate(10);

        return view('admin.orders.index', compact('orders'));
    }//End Method

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $order->update($request->validate([
            'status' => 'required|in:Processing,Confirmed,Shipping,Delivered,Cancelled'
        ]));

        return redirect()->back()->withSuccess('Order Updated.');

    }//End Method

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->details()->delete();
        $order->delete();

        return redirect()->back()->withSuccess('Order Removed.'); 

    }//End Method
}
