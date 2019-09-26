<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Controllers\UserController;
use App\Inventory;
use App\User;

class InventoryController extends Controller
{
    //
    public function getForm(Request $request){

    	return view('user/inventory_create')->with(['token'=>$request->token]);
    }


    public function getAllIventories(Request $request){
    	
    	$userController = new UserController();
    	$authUser = $userController->getAuthUser($request);

    	if($authUser){
    		if($authUser->user_role != 'admin'){
			$user = User::findOrFail($authUser->id);

    		$inventories = $user->inventories;
    		}else{
    		$inventories = Inventory::all();	
    		}
    		
    		return view('user/inventory_home')->with(['inventories'=>$inventories,'token'=>$request->token]);
    		
		}else{
			return "There was an error";
		}

    }

    public function store(Request $request){
    	$userController = new UserController();
    	$data = $request->all();
    	$authUser = $userController->getAuthUser($request);

    	if($authUser){

    		$user = User::findOrFail($authUser->id);

    		$inventory = new Inventory();
	    	$inventory->title = $request->title;
	        $inventory->category = $request->category;
	        $inventory->description = $request->description;
	        $inventory->price = $request->price;
	        $inventory->unit = $request->unit;
	        $inventory->status = $request->status;
	        $inventory->user_id = $authUser->id;
    	}

    	

        if($user->inventories()->save($inventory)){
        	return view('/user/home')->with(['token'=>$request->token]);
        
       // return redirect()->route('/inventories')->with(['token'=>$request->token]);
   		 }else{
			return "There was an error";
		}
	}

    public function getEditForm(Request $request,$id){
    	$userController = new UserController();
    	//$token = ['token'=>$token];
    	$authUser = $userController->getAuthUser($request);
    	 if ($authUser) {
    	 	$inventory = Inventory::findOrFail($id);

    	 	
    	 	return view('user/inventory_edit')->with(['token'=>$request->token,'inventory'=>$inventory]);
    	 }else{
			return "There was an error";
		}
    }

    public function updateInventory(Request $request,$id){
    	$userController = new UserController();
		$authUser = $userController->getAuthUser($request);

		if ($authUser) {
			$inventory = Inventory::findOrFail($id);


			$inventory->title = $request->title;
	        $inventory->category = $request->category;
	        $inventory->description = $request->description;
	        $inventory->price = $request->price;
	        $inventory->unit = $request->unit;
	        $inventory->status = $request->status;
	       
	        $inventory->save();

	        return view('/user/home')->with(['token'=>$request->token]);
		}else{
			return "There was an error";
		}
    }

     public function deleteInventory(Request $request,$id){
     	$userController = new UserController();
		$authUser = $userController->getAuthUser($request);

		if ($authUser) {
			$inventory = Inventory::findOrFail($id);

			$inventory->delete();
			return redirect()->back();

		}else{
			return "There was an error";
		}
     }
}
