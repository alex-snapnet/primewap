<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use App\Http\Requests;
use Microsoft\Graph\Graph;
use Microsoft\Graph\Model;
use Curl;

class MicrosoftController extends Controller
{
    //redirect to p[rovider]
	 
	public function redirectToProvider(){
		
		$client_id=env('MICROSOFT_CLIENT_ID','');
		$redirect_uri=env('MICROSOFT_AUTH_URL','');
		
		$tenantId=env('MICROSOFT_TENANTID','');
		return redirect("https://login.microsoftonline.com/$tenantId/oauth2/authorize?response_type=code&redirect_uri=$redirect_uri&client_id=$client_id");
	}
	
	public function getaccesstoken($granttype){
	  
	  $client_id=env('MICROSOFT_CLIENT_ID','');
		$redirect_uri=env('MICROSOFT_AUTH_URL','');
		$client_secret=env('MICROSOFT_CLIENT_SECRET','');
		$tenantId=env('MICROSOFT_TENANTID','');
	  try{
	  $code=session('code');
	  if($granttype=='refresh_token'){
		 $response = Curl::to("https://login.microsoftonline.com/$tenantId/oauth2/token?api-version=1.0")
        ->withData([
		 'grant_type' => $granttype,
		 'redirect_uri'=>$redirect_uri,
		 'client_id'=>$client_id,
		 'client_secret'=>$client_secret,
		 'refresh_token'=>session('refreshtoken'),
		 'resource'=>'https://graph.microsoft.com/'
		 ])->post();  
	  }
	  else{
	  $response = Curl::to('https://login.microsoftonline.com/common/oauth2/token')
        ->withData([
		 'grant_type' => $granttype,
		 'redirect_uri'=>$redirect_uri,
		 'client_id'=>$client_id,
		 'client_secret'=>$client_secret,
		 'code'=>$code,
		 'resource'=>'https://graph.microsoft.com/'
		 ])->post();
	  } 
		$response=json_decode($response);
	
		$accessToken=$response->access_token;
		$refreshtoken=$response->refresh_token;
		$notbeforetime=$response->expires_on;
		session(['expirytime'=>$notbeforetime]);
		session(['refreshtoken'=>$refreshtoken]);
		session(['accesstoken'=>$accessToken]);
		 return;
	  }
	  catch(\Exception $ex){
		  
		  return redirect('/')->with('message','Some error occurred');
	  }
	}
	
	public function refresh_token(){
		
		if(session()->has('expirytime')){
		if(time()>=session('expirytime')){	
		$accessToken=self::getaccesstoken('refresh_token');
		}
		}
		
	}
	
	
	public function getuserdetails(){
			
		$graph = new Graph();
      
        $graph->setBaseUrl("https://graph.microsoft.com/")
		->setApiVersion("beta")
		->setAccessToken(session('accesstoken'));
		
	    $user = $graph->createRequest("get", "/me")
                 ->setReturnType(Model\User::class)
                ->execute();
		return $user;
	}
	
	
	   //get details from callback
	public function callbackurl(Request $request){
	 
		try{
 
		if(\Auth::check()){
		    session(['microsoft'=>1]);
		   
		    	
		    return redirect('home');
		    
		}
		
		session(['code'=>$request->code]);
		$accessToken=self::getaccesstoken('authorization_code');
		$user=self::getuserdetails();
 
		$allowedEmail=['Primeatlanticnigeria.com','waelng.com','pagi-ng.com','pacenigeria.com','cinalt.com'];
		//\App\User::where('email',$user->getMail())->update(['role'=>3]);
		$email=explode('@', $user->getMail());
		if(in_array($email[1], $allowedEmail)){
		$data=['email'=>$user->getMail(),'name'=>$user->getGivenName(),'type'=>'prime_admin', 'password'=>bcrypt('peace133')];
		$getid=$this->checkUser($user->getMail());

		if($getid==0){
		 $getid=\App\User::updateOrCreate(['email'=>$user->getMail()],$data);
		 $getid=$getid->id;
		}
 		\Auth::loginUsingId($getid);
		 session(['microsoft'=>1]);
         return redirect('home');
		}
		else{
			  return redirect('login')->with('message','You are not Autorized, Please contact Your Administrator');
		}
 
		    
		}
		catch(\Exception $ex){
			
			return redirect('/')->with('message','Some error occurred');
		}
	}


	private function checkUser($email){
		$user=\App\User::where('email',$email)->value('id');
		if($user){
			return $user;
		}
		return 0;
	}
}
