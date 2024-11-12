<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\interfaces\UsersRepositoryInterface;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UsersRepository implements UsersRepositoryInterface
{
    public function all()
    {
        return User::all();
    }

    public function store($data)
    {
        $user = User::create([
            'id' => Str::uuid()->toString(),
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        if ($user) {
            return redirect()->route('users.index')->with('success', 'New User Added Successfully!');
        } else {
            return "failed to Register new User Try Again";
        }
    }

    public function edit($id)
    {
       return $user = User::findOrFail($id);
    }

    public function update($data, $id)
    {
        $user = User::findOrFail($id);
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->save();

        return redirect()->route('users.index')->with('success', 'User Updated Successfilly!');
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index')->with('success', "User: $user->name Deleted Successfully!");
    }
}
