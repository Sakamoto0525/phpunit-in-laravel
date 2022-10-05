<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
// use App\Http\Requests\Api\UserCreateRequest;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::all();
        if ($users->isEmpty()) return response()->json(null, 404);

        return response()->json(User::all(), 200);
    }

    public function show(int $id)
    {
        $user = User::find($id);
        if (is_null($user)) return response()->json(null, 404);

        return response()->json([
            'id'         => $user->id,
            'name'       => $user->name,
            'email'      => $user->email,
            'created_at' => $user->created_at,
            'updated_at' => $user->updated_at,
        ], 200);
    }

    // public function create(UserCreateRequest $request)
    // {
    //     $user = new User;
    //     $user->name = $request->input('name');
    //     $user->email = $request->input('email');
    //     $user->password = $request->input('password');
    //     $user->save();

    //     return response()->json(null, 201);
    // }

    public function update(Request $request, int $id)
    {
        $user = User::find($id);
        if (is_null($user)) return response()->json(null, 404);

        $user->name = $request->input('name');
        $user->password = $request->input('password');
        $user->save();

        return response()->json(null, 204);
    }

    public function delete(int $id)
    {
        $user = User::find($id);
        if (is_null($user)) return response()->json(null, 404);

        User::find($id)->delete();
        return response()->json(null, 204);
    }
}