<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\minmax;
use App\ecg_items;
use App\building;

class ECGItemsController extends Controller
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
        $minmax = minmax::orderBy('item_type')->get();
        if(empty($minmax)){
            return back()->with('error', 'Please ,Firstly, Create Min Max For Item Types');
        }
        return view('ecgItems.create')->with('minmax', $minmax);
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
            'model' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'energy_cg' => 'required',
            'item_type' => 'required',
            'energy_type' => 'required',
            'image' => 'image|nullable|max:1999',
        ]);

        if($request->hasFile('image'))
        {
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $path = $request->file('image')->storeAs('public/images', $fileNameToStore);
        }
        else
        {
            $fileNameToStore = 'noimage.png';
        }

        $ecg_item = new ecg_items;
        $ecg_item->model = $request->model; 
        $ecg_item->price = $request->price; 
        $ecg_item->energy_cg = $request->energy_cg; 
        $ecg_item->item_type = $request->item_type; 
        $ecg_item->energy_type = $request->energy_type; 
        $ecg_item->user_id = auth()->user()->id;
        $ecg_item->image = $fileNameToStore;
        $ecg_item->save();
        if(isset($request->check) && $request->check == 1){
            $building = building::orderBy('season', 'desc')->first();
            $ecg_item->buildings()->attach($building,['quantity' => $request->quantity]);
        }

        return back()->with('success','ECG Item Created');
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
        $ecg_item = ecg_items::findOrFail($id);
        $minmax = minmax::orderBy('item_type')->get();
        if(empty($minmax)){
            return back()->with('error', 'Please ,Firstly, Create Min Max For Item Types');
        }
        return view('ecgItems.edit')->with('ecg_item', $ecg_item)->with('minmax', $minmax);
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
            'model' => 'required',
            'price' => 'required',
            'energy_cg' => 'required',
            'item_type' => 'required',
            'energy_type' => 'required',
            'image' => 'image|nullable|max:1999',
        ]);

        if($request->hasFile('image'))
        {
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $path = $request->file('image')->storeAs('public/images', $fileNameToStore);
        }
        else
        {
            $fileNameToStore = 'noimage.png';
        }
        $building = building::orderBy('season', 'desc')->first();
        $ecg_item = ecg_items::findOrFail($id);
        $mycheck = 0;
        foreach($building->ecg_items as $item){
            if($item->id = $ecg_item->id)
            {
                $mycheck = 1;
                break;
            }
        }
        $ecg_item->model = $request->model; 
        $ecg_item->price = $request->price; 
        $ecg_item->energy_cg = $request->energy_cg; 
        $ecg_item->item_type = $request->item_type; 
        $ecg_item->energy_type = $request->energy_type; 
        $ecg_item->user_id = auth()->user()->id;
        $ecg_item->image = $fileNameToStore;
        if($request->hasFile('image'))
        {
            Storage::delete('public/images'.$ecg_item->image);
            $ecg_item->image = $fileNameToStore;
        }
        $ecg_item->save();
        if($mycheck == 1)
            $ecg_item->buildings()->detach($building);
        if($request->check == 1)
        {
            $ecg_item->buildings()->attach($building,['quantity' => $request->quantity]);
        }

        return back()->with('success','ECG Item Updated');
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

        $ecg_item = ecg_items::findOrFail($id);
        if($ecg_item->image != 'noimage.png' && $ecg_item->image != 'avatar.png')
        {
            Storage::delete('public/images/'.$ecg_item->image);
        }

        $ecg_item->buildings()->detach($ecg_item->buildings);
        $ecg_item->delete();
        return back()->with('success','ECG Item Deleted');
    }
}
