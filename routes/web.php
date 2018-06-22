<?php
use Illuminate\Support\Facades\Input;
Route::get('/', function () {
	//C1: return view('cats/show')->with('number',10);
	//C2: $number=10;   	return view('cats/show',compact('number'));
    //C3: return view('cats/show', array('number'=>10));
    	return redirect('cats');
});
// Display list cats
Route::get('/cats', function () {
    $cats=Furbook\Cat::all();
    return view('cats.index')->with('cats',$cats);
});
// Display info a cat
Route::get('/cats/{cat}', function (Furbook\Cat $cat) {
    // dd(DB::getQueryLog());
    $cat=Furbook\Cat::find($cat->id);
    return view('cats.show')->with('cat',$cat);
});//->where('id', '[0-9]+');
// Display list cats of breed
Route::get('/cats/breeds/{name}', function ($name) {
    $breed=Furbook\Breed::with('cats')->where('name',$name)->first();
    return view('cats.index')->with('breed',$breed)->with('cats',$breed->cats);
});
// Create a new cat
Route::get('/cats/create', function () {
        return view('cats.create');
});
Route::post('/cats', function () {
    //dd(Request::all());
    $cat=Furbook\Cat::create(Input::all());
    return redirect('cats/'.$cat->id)->with('cat',$cat)->withSuccess('Create cat success');
});
// Edit a cat
Route::get('/cats/{id}/edit', function ($id) {
    $cat=Furbook\Cat::find($id);
    return view('cats.edit')->with('cat',$cat);
});
Route::put('/cats/{id}', function ($id) {
    $cat=Furbook\Cat::find($id);
    $cat->update(Input::all());
    return redirect('cats/'.$cat->id)->withSuccess('Update cat success');
});
// Delete a cat
Route::get('/cats/{id}/delete', function ($id) {
    $cat=Furbook\Cat::find($id);
    $cat->delete();
    return redirect('cats')->withSuccess('Delete cat success');
});
Route::delete('/cats', function () {
    $id=Input::post('id');
    $cat=Furbook\Cat::find($id);
    $cat->delete();
    return redirect('cats')->withSuccess('Delete cat success');
});
