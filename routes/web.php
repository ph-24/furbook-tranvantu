<?php
Route::get('/', function () {
	//C1: return view('cats/show')->with('number',10);
	//C2: $number=10;   	return view('cats/show',compact('number'));
    //C3: return view('cats/show', array('number'=>10));
    	return redirect('cats');
}); 
// Display list cats of breed
Route::get('/cats/breeds/{name}', function ($name) {
    $breed=Furbook\Breed::with('cats')->where('name',$name)->first();
    return view('cats.index')->with('breed',$breed)->with('cats',$breed->cats);
});
Route::resource('cats','CatController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
