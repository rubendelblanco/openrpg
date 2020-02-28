<?php

namespace App\Http\Controllers\User;

use App\User;
use App\Http\Resources\Users\UserCollection;
use App\Http\Resources\Users\User as UserResource;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Hash;

class UserController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new UserCollection(User::paginate());
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
            'password' => 'same:repeat_password|min:8',
            'repeat_password' => 'same:password|min:8'
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->api_token = Str::random(60);

        if ($user->save()) {
            return $this->sendMessage('User was created');
        } else {
            return $this->sendMessage('Cannot create user', 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return new UserResource($user);
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
        if ($user->email !== $request->email) {
            $request->validate([
                'email' => 'required|email|unique:users,email'
            ]);
            $user->email = $request->email;
        }

        if (!empty($request->password)) {
            $request->validate([
                'password' => 'same:repeat_password|min:8',
                'repeat_password' => 'same:password|min:8'
            ]);

            $user->password = Hash::make($request->password);
        }

        if ($user->save()) {
            return $this->sendMessage('User was updated');
        } else {
            return $this->sendMessage('Cannot update user');
        }
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
        $email = null;

        if ($user->id != $current_user->id) {
            $email = $user->email;
            $response = $user->delete();
        } else {
            return $this->sendMessage('Cannot delete yourself', 403);
        }

        if ($response) {
            return $this->sendMessage('User was deleted');
        } else {
            return $this->sendMessage('Cannot delete user', 500);
        }
    }
}
