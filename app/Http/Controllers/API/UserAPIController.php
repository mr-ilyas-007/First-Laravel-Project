<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(User::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
        ]);
        $user = User::create([
            'id' => Str::uuid()->toString(),
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        $token = $user->createToken('Token')->plainTextToken;
        return response()->json(['Token' => $token, 'user' => $user], 200);
        // return response()->json(["result" => "User Added!", "data" => User::all()], 200);
    }

    function login(Request $request)
    {

        $data = [
            "email" => $request->email,
            "password" => $request->password
        ];

        if (auth()->attempt($data)) {
            $token = auth()->user()->createToken('Token')->accessToken;
            return response()->json(['Token' => $token], 200);
        } else {
            return response()->json(['error' => 'Unauthorized User'], 401);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return response()->json(["User" => $user], 200);
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
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required | email',
        ]);
        $user = User::find($id);
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->updated_at = now();
        $user->save();
        return response()->json(["result" => "User " . $data['name'] . " Updated!", "data" => User::all()], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return response()->json(['result' => "user " . $user->name . " moved to Trash Successfully!"], 200);
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////////////
    function trashed()
    {
        $users = User::onlyTrashed()->get();
        return response()->json(["result" => "List Of All the Trashed Users:", "data" => $users]);
    }

    function restore($id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $user->restore();
        return response()->json(['result' => "user " . $user->name . " Restored Successfully!"], 200);
    }

    function forceDelete($id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $user->forceDelete();
        return response()->json(['result' => "user " . $user->name . " Permanently Deleted Successfully!"], 200);
    }
}
