<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\building;
use App\ecg_items;
use App\User;
use App\minmax;
use App\phones;
use Hash;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $buildings = array();
        $minmaxes = array();
        $ecg_items = array();
        if(auth()->user()->type == "cm"){
            $buildings = building::orderBy('created_at', 'desc')->get();
            $minmaxes = minmax::orderBy('created_at', 'desc')->get();
            $ecg_items = ecg_items::orderBy('created_at', 'desc')->get();
        }
        return view('dashboard')->with('buildings', $buildings)->with('minmaxes', $minmaxes)->with('ecg_items', $ecg_items);
    }
    public function show()
    {
        return view('profiles.show')->with('user', auth()->user());
    }

    public function edit()
    {
        return view('profiles.edit');//->with('user', auth()->user());
    }

    public function update(Request $request)
    {
        if(!empty($request->phone))
        {
            $phone = new phone;
            $phone->user->id = auth()->user()->id;
            $phone->phone = $request->phone;
            $phone->save();
        }

        if(auth()->user()->id != $request->id){
            return back()->with('error', 'Authentification Privilage Error');
        }
        $this->validate($request, [
            'Fname' => ['required', 'string', 'max:255'],
            'Mname' => ['required', 'string', 'max:255'],
            'Lname' => ['required', 'string', 'max:255'],
            'Nickname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'cur_password' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'avatar_image' => 'image|nullable|max:1999',
        ]);


        if(!empty($request->file('avatar_image')))
        {
            $filenameWithExt = $request->file('avatar_image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('avatar_image')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $path = $request->file('avatar_image')->storeAs('public/images', $fileNameToStore);
        }
        else
        {
            $fileNameToStore = 'avatar.png';
        }
//        dd($data);
        $user = User::findOrFail($request->id);
        // echo()
        if(!Hash::check($request->cur_password, $user->password))
        {
            return back()->with('error', 'Current Password is Not Correct');   
        }
        
        $user->Fname = $request->Fname;//data['Fname'];
        $user->Mname = $request->Mname;//$data['Mname'];
        $user->Lname = $request->Lname;//$data['Lname'];
        $user->Nickname = $request->Nickname;//$data['Nickname'];
        $user->email = $request->email;//$data['email'];
        $user->password = Hash::make($request->password);//$data['password']);
        $user->avatar = $fileNameToStore;
        if($request->hasFile('avatar_image'))
        {
            Storage::delete('public/images'.$user->avatar);
            $user->avatar = $fileNameToStore;
        }
        $user->save();
        return back()->with('success','Profile Updated');
    }

    public function destroy()
    {
        $user = auth()->user();
        if($user->avatar != 'noimage.png' && $user->avatar != 'avatar.png')
        {
            Storage::delete('public/images/'.$user->avatar);
        }

        $user->delete();
        return back()->with('success','ECG Item Deleted');
    }
}
