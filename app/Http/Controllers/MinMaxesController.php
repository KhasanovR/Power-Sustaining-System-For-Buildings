<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\minmax;
class MinMaxesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',['except' => ['index', 'show']]);
    }
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(auth()->user()->type != 'cm'){
            return back()->with('error', 'Authentification Privilage Error');
        }
        return view('minmaxes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        if(auth()->user()->type != 'cm'){
            return back()->with('error', 'Authentification Privilage Error');
        }
        $this->validate($request, [
            'item_type' => 'required',
            'min' => 'required',
            'max' => 'required',
        ]);
        $minmax = new minmax;
        $minmax->item_type =$request->item_type;
        $minmax->min =$request->min;
        $minmax->max =$request->max;
        $minmax->save();
        return back()->with('success','Item Type Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($item_type)
    {
        if(auth()->user()->type != 'cm'){
            return back()->with('error', 'Authentification Privilage Error');
        }
        $minmax = minmax::findOrFail($item_type);
        return view('minmaxes.edit')->with('minmax', $minmax);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $item_type)
    {
        if(auth()->user()->type != 'cm'){
            return back()->with('error', 'Authentification Privilage Error');
        }
        $this->validate($request, [
            'item_type' => 'required',
            'min' => 'required',
            'max' => 'required',
        ]);
        $minmax = minmax::findOrFail($item_type);
        $minmax->item_type =$request->item_type;
        $minmax->min =$request->min;
        $minmax->max =$request->max;
        $minmax->save();
        return back()->with('success','Item Type Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($item_type)
    {
         if(auth()->user()->type != 'cm'){
            return back()->with('error', 'Authentification Privilage Error');
        }

        $minmax = minmax::findOrFail($item_type);
        $minmax->delete();
        return back()->with('success','Item Type Deleted');
    }
}
