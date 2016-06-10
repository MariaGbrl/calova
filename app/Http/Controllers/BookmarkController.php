<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Response;
use App\User;
use Auth;

use Validator;

class BookmarkController extends Controller
{

    public function index()
    {
    	$userid = Auth::user()->id;
    	$lol = User::find($userid)->event()->select('events.id','nama_event','gambar_event',\DB::raw('substr(isi, 1, 55) as mini_desc'),'tgl_event')->orderBy('id', 'desc')->paginate(9);
    	
   
    	
    	return Response::json($lol)->header('Content-Type', 'application/json');
    	//$lol = Events::select('id','nama_event','gambar_event',\DB::raw('substr(isi, 1, 55) as mini_desc'))->orderBy('id', 'desc')->paginate(9);
    }


    public function tambah($id)
    {
        $userid = Auth::user()->id;
        $user = User::find($userid);

        if (!$user->events->contains($id))
        {
            $user->events()->attach($id);
            return Response::json(['message' => 'success_attach']);
        }
        else
        {
            $user->events()->detach($id);
            return Response::json(['message' => 'success_detach']);
        }


    }
    
}
