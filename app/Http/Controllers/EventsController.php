<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Response;

use App\Events;
use App\User;
use Auth;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
    	$lol = Events::select('id','nama_event','gambar_event','tgl_event','type',\DB::raw('substr(isi, 1, 55) as mini_desc'))->orderBy('id', 'desc')->paginate(9);
    	return Response::json($lol)->header('Content-Type', 'application/json');
	//return Response::json(Events::select('id','nama_event','gambar_event','isi')->paginate(9))->header('Content-Type', 'application/json');
    }

    /**
     * add to pivot table
     *
     * @return Response
     */
    public function daftar($id)
    {
        $userid = Auth::user()->id;
        $user = User::find($userid);

        if (!$user->events->contains($id))
        {
            $user->events()->attach($id);
            return Response::json(['pesan' => 'sukses_mendaftar']);
        }
        else
        {
            return Response::json(['error' => 'sudah_daftar']);
        }

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
        $userid = Auth::user()->id;
        $user = User::find($userid)->events()->where('events_id',$id)->first();
        if($user != null){
        	$bookmark = true;
        }
        else{
        	$bookmark = false;
        }
        $data = array('bookmark' => $bookmark);
        $events = Events::where('id',$id)->first();
        return Response::json(array_merge($events->toArray(),$data));
    }
    
    public function highlight()
    {
    	return Response::json(Events::where('highlight','1')->first());
    }
    
    public function newhighlight()
    {
    	$data = Events::orderBy('id', 'desc')->take(3)->where('highlight','1')->get();
    	return Response::json(["data" => $data]);
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
}
