<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Customer;
use Session;


class CustomerController extends Controller
{
        
    // Get list of ingredients
    public function list(Request $req)
    {
        try 
        {
            $list = Customer::get();
            return response()->json($list, 200);
        }
        catch(\Exception $e)
        {           
            // Logs
            return response()->json($e, 400);
        }     
    }


    // add new item
    public function add(Request $req)
    {
        try 
        {
            $userId = Session::get('user');

            $item = new Customer;
            $item->name =  $req->name;
            $item->contact =  $req->contact;
            $item->email =  $req->email;
            $item->address =  $req->address;
            $res = $item->save();
    
            if($res)
            {
                $newItem = Customer::whereId($item->id)->first();
                return response()->json($newItem, 201);
            } 
    
            return response()->json("An error has occurred during saving", 400);
        }
        catch(\Exception $e)
        {           
            // Logs
            return response()->json($e, 400);
        }     
    }

}