<?php

namespace App\Http\Controllers\User;

use App\User;
use App\Http\Controllers\ApiController;
use App\Http\Requests\Users\UserStoreRequest;
use App\Http\Requests\Users\UserUpdateRequest;
use App\Http\Resources\Users\UserCollection;
use App\Http\Resources\Users\User as UserResource;

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
    public function store(UserStoreRequest $request)
    {
        $user = new User($request->validated());
        if ($user->save()) {
            return $this->sendMessage('Created successfully', 201)
                        ->header('Location', route('users.show', ['user' => $user->id]));
        } else {
            return $this->sendMessage('Cannot persist', 500);
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
    public function update(UserUpdateRequest $request, User $user)
    {
        $user->fill($request->validated());
        if ($user->save()) {
            return $this->sendMessage('Updated successfully');
        } else {
            return $this->sendMessage('Cannot persist', 500);
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
