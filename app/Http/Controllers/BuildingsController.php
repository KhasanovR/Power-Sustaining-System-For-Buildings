<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\building;
use App\User;
use App\level;

class BuildingsController extends Controller
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
        return view('buildings.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(auth()->user()->type != 'cm'){
            return back()->with('error', 'Authentification Privilage Error');
        }
        $this->validate($request, [
            'money_pack' => 'required',
            'price_kw' => 'required',
        ]);            





        $building = new building;
        $building->money_pack =$request->money_pack;
        $building->price_kw =$request->price_kw;
        $building->user_id = auth()->user()->id;
        $building->save();

        $users = User::where('type','pl')->get();
        
        foreach($users as $user)
        {
            if(!empty($user->rank))
            {
                $level = level::firstOrNew([
                'rank_id' => $user->rank->id]);
                $level->rank_id = $user->rank->id;
                $level->guide_bonus = 0;
                $level->level_no += $user->rank->rank_no;
                $level->save();
            }
        }
        return back()->with('success','Building Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         if(auth()->user()->type != 'cm'){
            return back()->with('error', 'Authentification Privilage Error');
        }
        $building = building::findOrFail($id);
        return view('buildings.edit')->with('building', $building);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(auth()->user()->type != 'cm'){
            return back()->with('error', 'Authentification Privilage Error');
        }
        $this->validate($request, [
            'money_pack' => 'required',
            'price_kw' => 'required',
        ]);

        $building = building::findOrFail($id);
        $building->money_pack =$request->money_pack;
        $building->price_kw =$request->price_kw;
        $building->user_id = auth()->user()->id;
        $building->save();
        return back()->with('success','Building Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(auth()->user()->type != 'cm'){
            return back()->with('error', 'Authentification Privilage Error');
        }

        $building = building::findOrFail($id);
        $building->ecg_items()->detach($building->ecg_items);
        $building->delete();
        return back()->with('success','ECG Item Deleted');
    }
}
