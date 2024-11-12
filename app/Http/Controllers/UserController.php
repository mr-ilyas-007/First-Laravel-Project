<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Repositories\interfaces\UsersRepositoryInterface;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserRequestValidation;

class UserController extends Controller
{

    private $usersRepository;
    public function __construct(UsersRepositoryInterface $usersRepository)
    {
        $this->usersRepository = $usersRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $users = User::all();
        $users  = $this->usersRepository->all();
        return view('users.all-users', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequestValidation $request)
    {
        $data = $request->validated();

        //without repository pattern
        // $user = User::create([
        //     'id' => Str::uuid()->toString(),
        //     'name' => $data['name'],
        //     'email' => $data['email'],
        //     'password' => Hash::make($data['password']),
        // ]);

        // if ($user) {
        //     return redirect()->route('users.index')->with('success', 'New User Added Successfully!');
        // } else {
        //     return "failed to Register new User Try Again";
        // }

        //with repository pattern
        return $this->usersRepository->store($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $user = User::findOrFail($id);
        $user = $this->usersRepository->edit($id);
        return view('users.edit', compact('user'));
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
            'name' => 'required',
            'email' => 'required | email'
        ]);

        //without repository pattern
        // $user = User::findOrFail($id);
        // $user->name = $request->name;
        // $user->email = $request->email;
        // $user->save();
        // return redirect()->route('users.index')->with('success', 'User Updated Successfilly!');

        //with repository pattern
        return $this->usersRepository->update($data,$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //without repository pattern
        // $user = User::findOrFail($id);
        // $user->delete();
        // return redirect()->route('users.index')->with('success', 'User Deleted Successfully!');

        //without repository pattern
        return $this->usersRepository->delete($id);
    }

    function trashed(){
        $users = User::onlyTrashed()->get();
        return view('users.trashed', compact('users'));
    }

    function restore($id){
        $user = User::withTrashed()->findOrFail($id);
        $user->restore();
        return redirect()->route('users.index')->with('success', 'Account restored successfully');
    }

    function forceDelete($id){
        $user = User::withTrashed()->findOrFail($id);
        $user->forceDelete(); // Permanently deletes the record
        return redirect()->route('accounts.index')->with('success', 'Account permanently deleted');
    }
}
