<?php

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    public function index()
    {
        return UserResource::collection(
            User::with('orders')->get()
        );
    }

    public function show(User $user)
    {
        return new UserResource(
            $user->load('orders')
        );
    }
}
