<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'Fname' => ['required', 'string', 'max:255'],
            'Mname' => ['required', 'string', 'max:255'],
            'Lname' => ['required', 'string', 'max:255'],
            'Nickname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'avatar_image' => 'image|nullable|max:1999',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        if(!empty($data['avatar_image']))
        {
            $filenameWithExt = $data['avatar_image']->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $data['avatar_image']->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $path = $data['avatar_image']->storeAs('public/images', $fileNameToStore);
        }
        else
        {
            $fileNameToStore = 'avatar.png';
        }
//        dd($data);
        $user = new User;
        $user->Fname = $data['Fname'];
        $user->Mname = $data['Mname'];
        $user->Lname = $data['Lname'];
        $user->Nickname = $data['Nickname'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->type = 'pl';
        $user->avatar = $fileNameToStore;
        $user->save();
        return $user;
//        return User::create([
//            'Fname' => $data['Fname'],
//            'Mname' => $data['Mname'],
//            'Lname' => $data['Lname'],
//            'Nickname' => $data['Nickname'],
//            'email' => $data['email'],
//            'password' => Hash::make($data['password']),
//        ]);
    }
}
