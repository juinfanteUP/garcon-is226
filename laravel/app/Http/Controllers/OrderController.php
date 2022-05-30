<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Customer;
use App\Models\OrderItem;
use Session;


class OrderController extends Controller
{

    // Get all ordered list
    public function list(Request $req)
    {
        try 
        {
            $refId = Session::get('order_id');
            $list = [];

            if (!is_null($refId)) {
                $list = OrderItem::where('order_id', $refId)->get();
            }

            return response()->json($list, 200);
        }
        catch(\Exception $e)
        {           
            // Logs
            return response()->json($e, 400);
        }   
    }


    // Place an order
    public function place(Request $req)
    {
        try 
        {
            $refId = Session::get('order_id');
            
            if(!is_null($refId)) 
            {
                $refId = Session::get('order_id');
            } 
            else 
            {
                $item = new Order;
                $item->reference_Id = substr(md5(uniqid(rand(), true)), 16);
                $res = $item->save();
                $refId = $item->id;
                Session::put('order_id', $refId);
            }

            for ($i = 0; $i < count($req->cartList); $i++) {
                $orderItem = new OrderItem;
                $orderItem->menu_id = $req->cartList[$i]['id'];
                $orderItem->quantity = $req->cartList[$i]['quantity'];
                $orderItem->order_id = $refId;
                $res = $orderItem->save();
            }

            return response()->json("Order placed. Order ID: " . $refId, 200);
        }
        catch(\Exception $e)
        {           
            // Logs
            return response()->json($e, 400);
        }   
    }



    // Bill out an order
    public function billout(Request $req)
    {
        try 
        {
            if(!$req->session()->has('order_id')) 
            {
                return response()->json("Billout denied. Please place an order first.", 403);
            } 

            $refId = Session::get('order_id');
            $order = Order::whereId($refId)->first();

            $cust = new Customer;
            $cust->name =  $req->customer['name'];
            $cust->contact =  $req->customer['contact'] ?? "";
            $cust->email =  $req->customer['email'] ?? "";
            $cust->address =  $req->customer['address'] ?? "";
            $res = $cust->save();

            $order = Order::whereId($order->id)
                            ->update([
                                'customer_id' => $cust->id,
                                'subtotal' => $req->order['subtotal'],
                                'service_cost' => $req->order['service_cost'],
                                'amount_paid' => $req->order['amount_paid'],
                                'customer_remarks' => $req->order['customer_remarks']
                            ]);

            Session::forget('order_id');
            return response()->json("Billout was successful", 200);
        }
        catch(\Exception $e)
        {           
            // Logs
            return response()->json($e, 400);
        }   
    }


        // Get list of orders
        public function history(Request $req)
        {
            try 
            {
                $list = Order::get();
                return response()->json($list, 200);
            }
            catch(\Exception $e)
            {           
                // Logs
                return response()->json($e, 400);
            }     
        }
}