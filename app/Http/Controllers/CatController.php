<?php

namespace Furbook\Http\Controllers;

use Validator;
use Furbook\Cat;
use Auth;
use Illuminate\Http\Request;
use Furbook\Http\Requests\CatRequest;

class CatController extends Controller
{
     public function __construct()
    {
        $this->middleware('admin')->only('destroy');
    }
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
        $request->validate(
            [
            'name'=>'required|max:255',
            'date_of_birth'=>'required|date_format:"Y-m-d"',
            'breed_id'=>'required|numeric'
            ],
            [
            'required'    => 'Cột :attribute là bắt buộc.',
            'max'    => 'Độ dài :attribute phải nhỏ hơn :max.',
            'numeric' => 'Cột :attribute phải là kiểu số.',
            'date_format' => 'Cột :attribute định dạng phải là "Y-m-d".',
            ]
        );
        //C2
        // $validator= Validator::make($request->all(),
        //     [
        //     'name'=>'required|max:255',
        //     'date_of_birth'=>'required|date_format:"Y/m/d"',
        //     'breed_id'=>'required|numeric'
        //     ],
        //     [
        //     'required'    => 'Cột :attribute là bắt buộc.',
        //     'max'    => 'Độ dài :attribute phải nhỏ hơn :max.',
        //     'numeric' => 'Cột :attribute phải là kiểu số.',
        //     'date_format' => 'Cột :attribute định dạng phải là "Y/m/d".',
        //     ]
        // );
        // if ($validator->fails()) {
        //     return redirect('cats/create')
        //                 ->withErrors($validator)
        //                 ->withInput();
        // }
        $user_id= Auth::user()->id;
        $request->request->add(['user_id'=> $user_id]);

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
        if (! Auth::user()->canEdit($cat)){
            return redirect()
                ->route('cats.index')
                ->withErrors('Permission denied');
        }
        return view('cats.edit')->with('cat',$cat);
    }

    public function update(CatRequest $request, $id)
    {
        $cat=Cat::find($id);
        $cat->update($request->all());
        return redirect()->route('cats.show',$cat->id)->withSuccess('Update cat success');
    }

    public function destroy($id)
    {
        $cat=Cat::find($id);
        $cat->delete();
        return redirect('cats')->withSuccess('Delete cat success');
    }
}
