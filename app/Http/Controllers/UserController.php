<?php
//namespace App\Http\Controllers\Auth;


// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\User;
use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class UserController extends Controller
{
	public $loginAfterSignUp = true;
    //
    public function index()
    {
        return view('user/login');
    }

    public function register()
    {
        return view('user/register');
    }

    

    public function store(Request $request){
    	$data = $request->all();

    	try{

	    	//Validate user details
	    	 $validate = Validator::make($data, [
	            'name' => 'required|string|max:255',
	            'email' => 'required|string|email|max:255|unique:users',
	            'password' => 'required|string|min:6|confirmed',
	        ]);

	    	$validate->validate();
	    	
	    	//Create User 
	    	$user = new User();
	    	
	        $user->name = $request->name;
	        $user->email = $request->email;
	        $user->user_role = !is_null($request->user_role)?$request->user_role:'user';
	        $user->password = bcrypt($request->password);

	        $user->save();

	        if (!$request->token) {

	            return $this->login($request);
	           
	        }else{
	        	return  view('/user/home')->with(['token'=>$request->token]);
	        }

    	}catch(\Exception $e){

    		return $e->getMessage();
    	}
    	
    	
    }

    public function login(Request $request){
    	$input = $request->only('email', 'password'); 

    	try{
			$jwt_token = JWTAuth::attempt($input);

	    	$validate = Validator::make($input, [
	            
	            'email' => 'required|string|email',
	            'password' => 'required|string|min:6',
	        ]);

	    	$validate->validate();

			$jwt_token = null;

			if (!$jwt_token = JWTAuth::attempt($input)) {
	            return redirect('/user');
	        }

	      
	        return  view('/user/home')->with(['token'=>$jwt_token]);
    	}catch(\Exception $e){
    		return $e->getMessage();
    	}

    	
    }


    public function logout(Request $request){

        $this->validate($request, [
            'token' => 'required'
        ]);


        try {
            JWTAuth::invalidate($request->token);
 			 return redirect('/user');
            
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function getAuthUser(Request $request){

        $this->validate($request, [
            'token' => 'required'
        ]);
 
       if($user = JWTAuth::authenticate($request->token)) {
       	 return $user;
       }else{
       	return "User Authentication Failed";
       }
       
    }

    public function getAllUsers(Request $request){
    	$authUser = $this->getAuthUser($request);

    	if($authUser){
    		$users = User::all();

    		return view('user/users')->with(['token'=>$request->token,'users'=>$users]);
    	}else{
    		return "User could not be authenticated";
    	}
    }
}
