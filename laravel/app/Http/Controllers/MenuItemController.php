<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\MenuItem;
use Session;


class MenuItemController extends Controller
{
        
    // Get list of ingredients
    public function list(Request $req)
    {
        try 
        {
            $list = MenuItem::get();
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

            $item = new MenuItem;
            $item->name =  $req->name;
            $item->price =  $req->price ?? 0;
            $item->description =  $req->description;
            $item->picture =  $req->picture;
            $item->category =  $req->category;
            $item->created_user = $userId ;
            $item->modified_user = $userId;
            $res = $item->save();
    
            if($res)
            {
                $newItem = MenuItem::whereId($item->id)->first();
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

    
    // add new file
    public function upload(Request $req)
    {
        try 
        {
            if($req->file())
            {
                $file = request()->file('uploadFile');
            
                $fileExt = $req->file->extension();
                $filePath = $req->file('file')
                                 ->storeAs('uploads', substr(md5(uniqid(rand(), true)), 16) . "." . $fileExt, 'uploads');

                $pictureUrl =  'public/' . $filePath;

                return response()->json($pictureUrl, 201);
            }

            return response()->json(null, 401);
        }
        catch(\Exception $e)
        {           
            // Logs
            return response()->json($e, 400);
        }     
    }


    // delete menu item
    public function delete(Request $req)
    {
        try 
        {
            $userId = "system"; // Session::get('user');
            $item = MenuItem::whereId($req->query('id'))->delete();
    
            return response()->json("Menu item [id:" . $req->id . "] deleted successfully", 200);
        }
        catch(\Exception $e)
        {           
            // Logs
            return response()->json($e, 400);
        }   
    }

    // Update menu item
    public function update(Request $req)
    {
        try 
        {
            $userId = "system"; // Session::get('user');

            $item = MenuItem::whereId($req->id)
                    ->update([
                        'name' => $req->name,
                        'price' =>  $req->price,
                        'description' => $req->description,
                        'picture' => $req->picture,
                        'category' => $req->category,
                        'modified_user' => $userId
                    ]);
    
            if($item)
            {
                $newItem = MenuItem::whereId($req->id)->first();
                return response()->json($newItem, 200);
            }
    
            return response()->json("An error has occurred during update", 400);
        }
        catch(\Exception $e)
        {           
            // Logs
            return response()->json($e, 400);
        }   
    }
}