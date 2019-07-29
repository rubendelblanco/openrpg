<?php

namespace App\Http\Controllers\User;

use Auth;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:4',
            'email' => 'required|email|unique:users,email',
            'password'  => 'same:repeat_password|min:6',
            'repeat_password'   => 'same:password|min:6'
        ]);
        
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        if ($user->save()){
            return [
                'response'=>'OK'
            ];
        }

        return ['response'=>'KO'];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return User::findOrFail($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {   
        $request->validate([
            'name' => 'required|min:4'
        ]);

        $user->name = $request->name;
        
        //if the email changes, then check out that new email doesn't exists in DB
        if ($user->email !== $request->email){
            $request->validate([
                'email' => 'required|email|unique:users,email'
            ]);
            $user->email = $request->email;
        }

        if (!empty($request->password)){
            $request->validate([
                'password'  => 'same:repeat_password|min:6',
                'repeat_password'   => 'same:password|min:6'
            ]);

            $user->password = Hash::make($request->password);
        }
        
        if ($user->save()){
            return [
                'response'=>'OK'
            ];
        }

        return ['response'=>'KO'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $current_user = auth('api')->user();
        $response = false;

        if ($user->id != $current_user->id){
           $response = $user->delete();
        }

        if ($response){
            return [
                'response'=>'OK'
            ];
        }

        return ['response'=>'KO'];
    }
}
