<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Response;

class QuizController extends Controller
{
	public function index()
	{
		
	        $musik = \App\Quiz::where('quizcat_id','1')->get();
	        $linguistik = \App\Quiz::where('quizcat_id','2')->get();
	        $sport = \App\Quiz::where('quizcat_id','3')->get();
	        $interpersonal = \App\Quiz::where('quizcat_id','4')->get();
	        $spasial = \App\Quiz::where('quizcat_id','5')->get();
	        $logic = \App\Quiz::where('quizcat_id','6')->get();
	        $intrapersonal = \App\Quiz::where('quizcat_id','7')->get();
		
		$total = \App\Quiz::count();
		
		$x1 = 0;
		$x2 = 0;
		$x3 = 0;
		$x4 = 0;
		$x5 = 0;
		$x6 = 0;
		$x7 = 0;
	
	        for($i=1;$i<=$total;$i++){
	        	$x = $i%7;
	        	if($x==0){ $item["data"][] = $musik[$x1]; $x1++;}
	        	if($x==1){ $item["data"][] = $linguistik[$x2]; $x2++;}
	        	if($x==2){ $item["data"][] = $sport[$x3]; $x3++;}
	        	if($x==3){ $item["data"][] = $interpersonal[$x4]; $x4++;}
	        	if($x==4){ $item["data"][] = $spasial[$x5]; $x5++;}
	        	if($x==5){ $item["data"][] = $logic[$x6]; $x6++;}
	        	if($x==6){ $item["data"][] = $intrapersonal[$x7]; $x7++;}
	        }
        
        	return Response::json(["total" => $total,"data" => $item["data"]]);
	
	}
	
	public function destroy()
	{
		if(\DB::table('user_score')->where('user_id',\Auth::user()->id)->first() !== null){
			\DB::table('user_score')->where('user_id',\Auth::user()->id)->delete();
			return Response::json(['message' => 'user quiz deleted']);
		}
		else
		{
			return Response::json(['error' => 'what should i delete ?']);
		}
	}
	
	public function post(Request $request)
	{
		if(\DB::table('user_score')->where('user_id',\Auth::user()->id)->first() !== null){
			return Response::json(['error' => 'user already submit']);
		}
		
		else{
			$musik = \App\Quiz::where('quizcat_id','1')->get()->toArray();
		        $linguistik = \App\Quiz::where('quizcat_id','2')->get()->toArray();
		        $sport = \App\Quiz::where('quizcat_id','3')->get()->toArray();
		        $interpersonal = \App\Quiz::where('quizcat_id','4')->get()->toArray();
		        $spasial = \App\Quiz::where('quizcat_id','5')->get()->toArray();
		        $logic = \App\Quiz::where('quizcat_id','6')->get()->toArray();
		        $intrapersonal = \App\Quiz::where('quizcat_id','7')->get()->toArray();
			
			$x1 = 0;
			$x2 = 0;
			$x3 = 0;
			$x4 = 0;
			$x5 = 0;
			$x6 = 0;
			$x7 = 0;
		
		        for($i=1;$i<=35;$i++){
		        	$x = $i%7;
		        	if($x==0){ $item["data"][] = $musik[$x1]; $x1++;}
		        	if($x==1){ $item["data"][] = $linguistik[$x2]; $x2++;}
		        	if($x==2){ $item["data"][] = $sport[$x3]; $x3++;}
		        	if($x==3){ $item["data"][] = $interpersonal[$x4]; $x4++;}
		        	if($x==4){ $item["data"][] = $spasial[$x5]; $x5++;}
		        	if($x==5){ $item["data"][] = $logic[$x6]; $x6++;}
		        	if($x==6){ $item["data"][] = $intrapersonal[$x7]; $x7++;}
		        }     

	
			$result = self::my_array_merge($item,$request);		
			
			$cat1 = self::custom_search($result,'1');
			$cat2 = self::custom_search($result,'2');
			$cat3 = self::custom_search($result,'3');
			$cat4 = self::custom_search($result,'4');
			$cat5 = self::custom_search($result,'5');
			$cat6 = self::custom_search($result,'6');
			$cat7 = self::custom_search($result,'7');
			
			$count1 = self::hitung($cat1,$result);
			$count2 = self::hitung($cat2,$result);
			$count3 = self::hitung($cat3,$result);
			$count4 = self::hitung($cat4,$result);
			$count5 = self::hitung($cat5,$result);
			$count6 = self::hitung($cat6,$result);
			$count7 = self::hitung($cat7,$result);
			
			$id = \Auth::user()->id;
			\DB::table('user_score')->insert([
				'score_musik' => $count1,
				'score_linguistik' => $count2,
				'score_sport' => $count3,
				'score_interpersonal' => $count4,
				'score_spasial' => $count5,
				'score_logic' => $count6,
				'score_intrapersonal' => $count7,
				'user_id' => $id
			]);
			
			return Response::json(['message' => 'success submit quiz']);
		}

	}
	
	function hitung($category,$result)
	{
		$count = 0;
		foreach($category as $cat)
		{
			$count = $count + $result[$cat]['jawaban'];
		}
		return $count;
	}
	
	function my_array_merge(&$array1, &$array2) {
	    $result = Array();
	    foreach($array1["data"] as $key => &$value) {
	        $result[$key] = array_merge($value, $array2["data"][$key]);
	    }
	    return $result;
	}
	
	function custom_search ($arr, $a)
	{
	    $r = array();
	    foreach ($arr as $key => $test) {
	        if ($test['quizcat_id'] === $a) {
	            $r[] = $key;
	        }
	    }
	
	    return $r;
	}
	
	public function showevent()
	{
		$userid = \Auth::user()->id;
		$datau = \App\Userquiz::where('user_id',$userid)->select('score_musik','score_linguistik','score_sport','score_interpersonal','score_spasial','score_logic','score_intrapersonal')->first();
		if($datau !== null){
			$x = $datau->toArray();
    			$max = max($x);
    			$index = array_search($max,$x);
			$index = str_replace('score_','',$index);
			return Response::json(['strength' => $index]);
		
		
		}
		else
		{
			return Response::json(['error' => 'user belum submit']);
		}

	}

	
	public function getRecommended()
	{
		$userid = \Auth::user()->id;
		$datau = \App\Userquiz::where('user_id',$userid)->select('score_musik','score_linguistik','score_sport','score_interpersonal','score_spasial','score_logic','score_intrapersonal')->first();
		if($datau !== null){
			$x = $datau->toArray();
    			$max = max($x);
    			$index = array_search($max,$x);
    			
    			
    			switch ($index) {
			    case 'score_musik':
			        $quizcat = 1;
			        break;
			    case 'score_linguistik':
			        $quizcat = 2;
			        break;
			    case 'score_sport':
			        $quizcat = 3;
			        break;
			    case 'score_interpersonal':
			        $quizcat = 4;
			        break;
			     case 'score_spasial':
			        $quizcat = 5;
			        break;
			    case 'score_logic':
			        $quizcat = 6;
			        break;
			    case 'score_intrapersonal':
			        $quizcat = 7;
			        break;
			    default :
			    	$quizcat = 0;
			       
			}
    			
			$x = \App\Quizcat::where('quizcat.id',$quizcat)
				->join('interest_quizcat','quizcat.id','=','interest_quizcat.quizcat_id')
				->join('interest','interest_quizcat.interest_id','=','interest.id')
				->join('events_interest','interest.id','=','events_interest.interest_id')
				->join('events','events_interest.events_id','=','events.id')
				->select('events.id','nama_event','gambar_event','type',\DB::raw('substr(isi, 1, 55) as mini_desc'),'tgl_event')
				->orderBy('id', 'desc')
				->groupBy('events.id')
				->paginate(9);
			
			return Response::json($x);
		
		
		}
		else
		{
			return Response::json(['error' => 'user belum submit']);
		}

	}

}