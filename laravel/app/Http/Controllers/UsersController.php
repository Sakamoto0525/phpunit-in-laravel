<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    /**
     * \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(User::all(), 200);
    }

    public function create(): \Illuminate\Http\Response
    {
        //
    }

    public function store(Request $request): \Illuminate\Http\Response
    {
        //
    }

    public function show(int $id): \Illuminate\Http\Response
    {
        //
    }

    public function edit(int $id): \Illuminate\Http\Response
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
