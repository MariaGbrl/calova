<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Response;
use App\Interest;
use App\User;
use App\Events;
use Auth;

use Validator;

class InterestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
    	$waseng = Interest::all();
        return Response::json(["total" => count($waseng),"item" => $waseng]);
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

    public function tambah($id)
    {
        $userid = Auth::user()->id;
        $user = User::find($userid);

        if (!$user->interest->contains($id))
        {
            $user->interest()->attach($id);
            return Response::json(['pesan' => 'success_attach']);
        }
        else
        {
            $user->interest()->detach($id);
            return Response::json(['pesan' => 'success_detach']);
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
        $validator = Validator::make($request->all(),[
            'name_interest' => 'unique:interest'
        ]);

        if ($validator->fails()) {
            return Response::json(['error' => 'name_interest already in database'],500);
        }
        else{
            $interest = new Interest;
            $interest->name_interest = $request->input('name_interest');
            $interest->save();
            return Response::json(['pesan' => 'sukses_input_data']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
    	//$data = Interest::where('id',$id)->with('events')->paginate(9);
    	$data = Interest::where('id',$id)->first()->events()->select('events.id','nama_event','gambar_event','tgl_event','type',\DB::raw('substr(isi, 1, 55) as mini_desc'))->orderBy('id', 'desc')->paginate(9);
        return Response::json($data);
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