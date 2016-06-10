<?php


//untuk halaman depan

Route::get('/', function () {
    return view('welcome');
});

Route::get('/wow', function(){
	$quizcat = '1';
	$x = App\Quizcategory::where('quizcat.id',$quizcat)
		->join('interest_quizcat','quizcat.id','=','interest_quizcat.quizcat_id')
		->join('interest','interest_quizcat.interest_id','=','interest.id')
		->join('events_interest','events_interest.interest_id','=','interest.id')
		->join('events','events.id','=','events_interest.events_id')
		->select('events.id','nama_event','gambar_event',\DB::raw('substr(isi, 1, 55) as mini_desc'))
		->orderBy('id', 'desc')
		->paginate(9);
	return $x;
});



Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

Route::group(['prefix' => 'mimin','middleware' => 'auth'], function () {
	Route::get('/','MiminController@index');
	Route::get('events','MiminController@events');
	Route::get('users','MiminController@users');
	
	
	Route::get('add','MiminController@add');
	Route::get('del/{id}','MiminController@destroy');
	Route::post('add','MiminController@store');
	
	Route::get('edit/{id}','MiminController@edit');
	Route::post('edit/{id}','MiminController@postedit');
	
	Route::get('category','MiminController@category');
	Route::post('category','MiminController@postcategory');
	Route::get('delcat/{id}','MiminController@delcat');
	Route::get('category/{id}','MiminController@showedit');
	Route::post('category/{id}','MiminController@editcategory');

});
//untuk bagian api json

Route::group(['prefix' => 'api'], function () {


    //buat login
    Route::post('authenticate', 'AuthenticateController@authenticate');

    Route::get('auth/twitter', 'Auth\AuthController@redirectToProvider');
    Route::get('auth/twitter/callback', 'Auth\AuthController@handleProviderCallback');

    Route::get('auth/facebook', 'Auth\AuthController@FBredirectToProvider');
    Route::get('auth/facebook/callback', 'Auth\AuthController@FBhandleProviderCallback');

    Route::post('auth/kirim_token','AuthenticateController@kirimToken');
    //Route::match(['get', 'post'], 'auth/kirim_token', 'AuthenticateController@kirimToken');
    
    Route::post('auth/test','AuthenticateController@test');

	
	
	
    Route::group(['middleware' => 'jwt.auth'],function(){
        Route::get('dashboard',function(){
           $token = JWTAuth::getToken();
           $user = JWTAuth::toUser($token);

           return Response::json([
               'data' => [
                    'name' => $user->name,
                    'email' => $user->email,
                    'avatar' => $user->avatar,
                    'registered_at' => $user->created_at->toDateTimeString(),
                    'version_code' => '5'
               ]
           ]);
        });
        
        Route::get('search/{keyword}',function($keyword){
        	$event = \DB::table('events')->where('nama_event','LIKE',"%$keyword%")->paginate(9);
        	return Response::json($event);
        });
        
    	//buat event
    	Route::get('event','EventsController@index');    	    
    	Route::get('event/{id}','EventsController@show');
    	    
    	Route::get('highlight','EventsController@highlight');        
        Route::get('newhighlight','EventsController@newhighlight');
        
        Route::post('event/daftar/{id}','EventsController@daftar');

        Route::get('interest','InterestController@index');
        Route::post('interest/store','InterestController@store');
        Route::get('interest/{id}','InterestController@tambah');
        
        Route::get('category/{id}','InterestController@show');
        
        Route::get('bookmark','BookmarkController@index');
        
        Route::get('bookmark/{id}','BookmarkController@tambah');
        
        Route::get('quiz','QuizController@index');
        
        Route::post('quiz/update','QuizController@post');
        
        Route::get('recommended','QuizController@showevent');
        
        Route::get('getRecommended','QuizController@getRecommended');
        
        Route::get('quiz/destroy','QuizController@destroy');
        

    });
});
