<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Response;

use App\Events;
use App\Interest;
use App\User;
use App\Quizcat;
use Auth;

class MiminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
    	$total = User::count();
    	$event = Events::count();
        return view('mimin.index',['total' => $total,'event' => $event]);
    }
    
    public function events()
    {
    	$events = Events::orderBy('id', 'desc')->paginate(15);
    	return view('mimin.events',['events' => $events]);
    }
    
    public function users()
    {
    	$users= User::paginate(15);
    	return view('mimin.users',['users' => $users]);
    }
    
    public function category()
    {
    	$cat = Interest::all();
    	$quizcat = Quizcat::all();
        return view('mimin.category',['cat' => $cat,'quizcat' => $quizcat]);
    }
    
    public function showedit($id)
    {
        $catz = Interest::where('id',$id)->first();
        $catx = $catz->quizcat()->get();
        
        if(!isset($catx))
        {
        	foreach($catx as $cat){
        		$checked[] = $cat->id;
        	}
        }
        else{
        	$checked[] = [0];
        }
        
        
        
    	$quizcat = Quizcat::whereNotIn('id',$checked)->get();
        return view('mimin.editcat',['catz' => $catz,'quizcat' => $quizcat,'catx' => $catx]);
    }

    public function editcategory($id,Request $request)
    {
    
        $validator = \Validator::make($request->all(), [
            'quizcat_interest' => 'required',
            'name_interest' => 'required',
            'image' => 'image|mimes:jpeg,bmp,png,gif'
        ]);
        
        
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        
        if ($request->hasFile('image'))
        {
            $x = \DB::table('interest')->where('id',$id)->first();
            $x = str_replace("http://calova.id/assets","",$x->image);
            $x1= "../public_html/assets/$x";
            \File::delete($x1);

            $destinationPath = '../public_html/assets/';
            $fileName = date("Ymdhis").'.'.$request->file('image')->getClientOriginalExtension();
            $request->file('image')->move($destinationPath, $fileName);

            $forimage = Interest::findOrFail($id);
            $forimage->image = "http://calova.id/assets/$fileName";
            $forimage->save();
        }
    
        $int = Interest::findOrFail($id);
        $input = $request->only('name_interest');
        $int->fill($input)->save();
    	
    	\DB::table('interest_quizcat')->where('interest_id',$id)->delete();
    	
      	foreach($request->input('quizcat_interest') as $quizcatInt)
    	{
    		$int->quizcat()->attach($quizcatInt);	
    	} 

        return redirect('mimin/category')->with('status', 'Sukses edit category');
    }

    public function postcategory(Request $request)
    {
    	$int = new Interest;
    	$int->name_interest = $request->input('name_interest');
    	$int->save();

        return redirect('mimin/category')->with('status', 'Sukses tambah category');
    }
    
    public function delcat($id)
    {
    	$int = Interest::where('id',$id)->first();

    	foreach($int->events as $event)
    	{
    		$event->interest()->detach($id);
    	}
    	\DB::table('interest')->where('id',$id)->delete();
    	\DB::table('interest_quizcat')->where('interest_id',$id)->delete();
    	
        return redirect('mimin/category')->with('status', 'Sukses detach category');
    }
    
    public function add()
    {
    	$interests = Interest::all();
    	return view('mimin.store',['interests' => $interests]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
    
        $validator = \Validator::make($request->all(), [
            'image' => 'required|mimes:jpeg,bmp,png'
        ]);

        if ($validator->fails()) {
            return redirect('mimin/add')
                        ->withErrors($validator)
                        ->withInput();
        }
    
    	if ($request->hasFile('image'))
    	{
    	    $destinationPath = '/public/imagesup/';
    	    $fileName = date("Ymdhis").'.'.$request->file('image')->getClientOriginalExtension();
    	    $request->file('image')->move($destinationPath, $fileName);
    	}
	
    	$event = new Events(array(
    		'nama_event' => $request->input('nama_event'),
    		'tgl_event' => $request->input('tgl_event'),
    		'organizer' => $request->input('organizer'),
    		'location' => $request->input('location'),
    		'link' => $request->input('link'),
    		'isi' => $request->input('isi'),
    		'highlight' => $request->input('highlight'),
    		'deadline' => $request->input('deadline'),
    		'biaya' => $request->input('biaya'),
    		'persyaratan' => $request->input('persyaratan'),
    		'type' => $request->input('type'),
    		'gambar_event' => "http://calova.id/imagesup/$fileName"
    	));

        $event->save();
	
    	foreach($request->input('events_interest') as $eventInt)
    	{
    		$event->interest()->attach($eventInt);	
    	}
	    return redirect('mimin/events')->with('status', 'Sukses tambah events');
      
    }
    
    public function postedit($id,Request $request)
    {
    
        $validator = \Validator::make($request->all(), [
            'image' => 'mimes:jpeg,bmp,png'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        
    	if ($request->hasFile('image'))
    	{
    	    $x = \DB::table('events')->where('id',$id)->first();
    	    $x = str_replace("http://calova.id/imagesup","",$x->gambar_event);
    	    $x1= "../public_html/imagesup/$x";
    	    \File::delete($x1);
    	
    	    $destinationPath = '../public_html/imagesup/';
    	    $fileName = date("Ymdhis").'.'.$request->file('image')->getClientOriginalExtension();
    	    $request->file('image')->move($destinationPath, $fileName);
    	    
    	    $forimage = Events::findOrFail($id);
        	$forimage->gambar_event = "http://calova.id/imagesup/$fileName";
        	$forimage->save();
    	}    
    
    	$event = Events::findOrFail($id);
    	$input = $request->all();
    	$event->fill($input)->save();
 

    	
    	\DB::table('events_interest')->where('events_id',$id)->delete();
    	
        foreach($request->input('events_interest') as $eventInt)
        {
            $event->interest()->attach($eventInt);	
        }  	
    	
	   return redirect('mimin/events')->with('status', 'Sukses edit events');
    }

    public function show($id)
    {
        
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {   	
    	$events = Events::where('id',$id)->first();
    	$interestX = $events->interest()->get();
    	
    	if(!isset($interestX))
    	{
	    	foreach($interestX as $interest){
	    		$checked[] = $interest->id;
	    	}
    	}
    	else
    	{
    		$checked[] = [0];
    	}
    	$interests = Interest::whereNotIn('id',$checked)->get();
    	return view('mimin.edit',['events' => $events,'interests' => $interests,'interestX' => $interestX]);
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
    	$x = \DB::table('events')->where('id',$id)->first();
    	$x = str_replace("http://calova.id/imagesup","",$x->gambar_event);
    	$filename = "../public_html/imagesup/$x";
    	\File::delete($filename);
        \DB::table('events')->where('id',$id)->delete();
        \DB::table('events_interest')->where('events_id',$id)->delete();
        \DB::table('user_events')->where('events_id',$id)->delete();
        return redirect('mimin/events')->with('status', 'Sukses delete events');
    }
}
