<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use JWTAuth;
use Tymon\JWTAuth\Exception\JWTException;

use Auth;

use App\User;

use Facebook;

class AuthenticateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // TODO : Show Events
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->only('email','password');

        try{
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        return response()->json(compact('token'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    public function test(Request $request)
    {
        $token = (string) $request->input('FBtoken');
        //$token = Request::input('FBtoken');
        
        $fb = new Facebook\Facebook([
	  'app_id' => '1479701339013270',
	  'app_secret' => 'f8d868e004c54395eedb9ec16154abab',
	  'default_graph_version' => 'v2.4',
	]);
        $fb->setDefaultAccessToken($token);
        try {
            $response = $fb->get("/me/?fields=id,name,email,gender,cover",$token);
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
            return response()->json(array('success' => 'false' , 'message' => $e->getMessage()));
        }

        // Convert the response to a `Facebook/GraphNodes/GraphUser` collection
        $facebook_user = $response->getGraphUser();
        $data = json_decode($facebook_user);
        
        //dd($data);
        
        $user = User::where('provider_id',$data->id)->first();
        if(!$user)
        {
            $user = new User;
            $user->name = $data->name;
            if (array_key_exists("email",$data))
            {
            	$user->email = $data->email;
            }
            else
            {
            	$user->email = $data->id."@facebook.com";
            }
            $user->password = 'FB_AUTH';
            if (array_key_exists("cover",$data)) $user->avatar = $data->cover->source;
            $user->provider = 'facebook';
            $user->provider_id = $data->id;
            $user->save();
        }

        $token = JWTAuth::fromUser($user);

        return response()->json(array('success' => 'true' , 'token' => $token));

    }
    
    
    public function kirimToken(Request $request)
    {
        $token = (string) $request->input('FBtoken');
        //$token = Request::input('FBtoken');
        
        $fb = new Facebook\Facebook([
	  'app_id' => '1479701339013270',
	  'app_secret' => 'f8d868e004c54395eedb9ec16154abab',
	  'default_graph_version' => 'v2.4',
	]);
        $fb->setDefaultAccessToken($token);
        try {
            $response = $fb->get("/me/?fields=id,name,email,gender,cover",$token);
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
            return response()->json(array('success' => 'false' , 'message' => $e->getMessage()));
        }

        // Convert the response to a `Facebook/GraphNodes/GraphUser` collection
        $facebook_user = $response->getGraphUser();
        $data = json_decode($facebook_user);
        
        $user = User::where('provider_id',$data->id)->first();
        if(!$user)
        {
            $user = new User;
            $user->name = $data->name;
            if (array_key_exists("email",$data))
            {
            	$user->email = $data->email;
            }
            else
            {
            	$user->email = $data->id."@facebook.com";
            }
            $user->password = 'FB_AUTH';
            //if (array_key_exists("cover",$data)) $user->avatar = $data->cover->source;
            $user->avatar = "http://graph.facebook.com/".$data->id."/picture?type=large";
            $user->provider = 'facebook';
            $user->provider_id = $data->id;
            $user->save();
        } else {
            $user->name = ($user->name != $data->name ? $data->name : $user->name);
	    if (array_key_exists("email",$data))
            {
            	$user->email = ($user->email != $data->email ? $data->email : $user->email);
            }
            $user->avatar = "http://graph.facebook.com/".$data->id."/picture?type=large";
            $user->save();
        }

        $token = JWTAuth::fromUser($user);

        return response()->json(array('success' => 'true' , 'token' => $token));
        

    }    
    
}