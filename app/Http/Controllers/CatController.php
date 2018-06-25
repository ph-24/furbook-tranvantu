<?php

namespace Furbook\Http\Controllers;

use Illuminate\Http\Request;
use Furbook\Cat;

class CatController extends Controller
{
    public function index()
    {
        $cats = Cat::all();
        return view('cats/index')->with('cats', $cats);
    }

    public function create()
    {
        return view('cats.create');
    }

    public function store(Request $request)
    {
        $cat = Cat::create($request->all());
        return redirect()
            ->route('cats.show', $cat->id)
             ->with('cat', $cat)
            ->withSuccess('Create cat success');
    }

    public function show($id)
    {
        $cat=Cat::find($id);
        return view('cats.show')->with('cat',$cat);
    }

    public function edit($id)
    {
        $cat=Cat::find($id);
        return view('cats.edit')->with('cat',$cat);
    }

    public function update(Request $request, $id)
    {
        $cat=Cat::find($id);
        $cat->update($request->all());
        return redirect('cats/'.$cat->id)->withSuccess('Update cat success');
    }

    public function destroy($id)
    {
        $cat=Cat::find($id);
        $cat->delete();
        return redirect('cats')->withSuccess('Delete cat success');
    }
}
