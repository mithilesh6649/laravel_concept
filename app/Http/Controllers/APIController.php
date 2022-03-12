<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
class APIController extends Controller
{
  public  function getUsers($id =null){
    	if(empty($id))
    	{
    		$all_data = User::all();
    	  return response()->json([
                 "status" => 'success',
                 "data" => $all_data,
    	      ],200);	 
    	}
    	else{
    	   $all_data = User::find($id);
    	     return response()->json([
                 "status" => 'success',
                 "data" => $all_data,
    	      ],200);  
    	}
    }
  

   public function addUsers(Request $request){
 
          $userData = $request->all();
       //return [$userData['name']];
          //check empty fileds.............
   if(empty($userData['name']) || empty($userData['email']) || empty($userData['password']))
   {
   	 $message = "Please enter complete details";
   	 return response()->json([
          "status" => false,
          "message"=> $message
   	   ],422);
   }
 
   
    //check valid email.............
if (!filter_var($userData['email'], FILTER_VALIDATE_EMAIL)) {
  $message = "Invalid email format";
  	 return response()->json([
          "status" => false,
          "message"=> $message
   	   ],422);
}
    
//check email exist..............

   $userCount = User::where('email',$userData['email'])->count();
   
   if($userCount>0)
   {
   	 $message = "Email  already exists !";
  	 return response()->json([
          "status" => false,
          "message"=> $message
   	   ],422);
   }

   $user = User::create([
                 'name' => $request->name,
                 'email' => $request->email,
                 'password' => Hash::make(trim($request->password))	
        	  ]);
            
            return response()->json([
                'status' => 'User added successfully',
                'data' => $user
            ]);



  //Object se data chahiye to -> ka use karte hai otherwise req[''] for arrray




       //type -1
   /*   $validator =   Validator::make($request->all(),[
               'name' => 'required | max:255',
               'email'=> 'required | email | max:255',
               'password' => 'required',
  
        ]);

        if(!$validator->fails()){
        	$user = User::create([
                 'name' => $request->name,
                 'email' => $request->email,
                 'password' => Hash::make($request->password)	
        	  ]);
            
            return response()->json([
                'status' => 'User added successfully',
                'data' => $user
            ]);

        }
        else{
        	return [ $validator->errors() ];
        }*/
   }

  
 


}
