<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::all();

        if ($users->isEmpty()) return response()->json(null, 404);

        return response()->json(User::all(), 200);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(int $id)
    {
        //
    }

    public function edit(int $id)
    {
        //
    }

    public function update(Request $request, int $id): \Illuminate\Http\Response
    {
        //
    }

    public function destroy(int $id): \Illuminate\Http\Response
    {
        //
    }
}
