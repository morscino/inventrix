<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    //

    public function getCreatePage(Request $request){
    	
    	$userController = new UserController();
    	$authUser = $userController->getAuthUser($request);

    	if($authUser){
    		return view('user/user_create')->with(['token'=>$request->token]);
    	}else{
    		return "User could not be authenticated";
    	}
    }

    public function store(Request $request){

    	$userController = new UserController();
    	$authUser = $userController->getAuthUser($request);

    	if($authUser){
    		
    		return $userController->store($request);
    	}else{
    		return "User could not be authenticated";
    	}
    	
    }

    public function getEditForm(Request $request,$id){
    	$userController = new UserController();
    	
    	$authUser = $userController->getAuthUser($request);
    	 if ($authUser) {
    	 	$user = User::findOrFail($id);

    	 	
    	 	return view('user/user_edit')->with(['token'=>$request->token,'user'=>$user]);
    	 }else{
			return "There was an error";
		}

    }


    public function updateUser(Request $request,$id){
    	$userController = new UserController();
		$authUser = $userController->getAuthUser($request);

		//Validate user details
    	$validate = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
        ]);

    	if(!is_null($request->password)){

    	 	$validate = Validator::make(array('password'=> $request->password), [
             'password' => 'required|string|min:6|confirmed',
        	]);
    	}

    	$validate->validate();

		if ($authUser) {
			$user = User::findOrFail($id);

			$user->name = $request->name;
	        $user->email = $request->email;
	        $user->user_role = !is_null($request->user_role)?$request->user_role:'user';

	        if(!is_null($request->password)){
	        $user->password = bcrypt($request->password);	
	        }
	       

	        $user->save();

	        return view('/user/home')->with(['token'=>$request->token]);
		}else{
			return "This User was not authenticated";
		}
    }

    public function deleteUser(Request $request,$id){
    	$userController = new UserController();
		$authUser = $userController->getAuthUser($request);

		if ($authUser) {
			$user = User::findOrFail($id);

			$user->delete();
			//return view('/user/home')->with(['token'=>$request->token]);

			return redirect()->back();

		}else{
			return "There was an error";
		}
    }
}
