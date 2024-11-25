<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Str;
use App\Traits\DynamicFormTrait;

class AuthController extends Controller
{
    use DynamicFormTrait;
    function index()
    {
        return view('frontend.home');
    }

    function registerPage()
    {
        $fields = $this->getFormFields('login', 'fields');
        return view('frontend.register', compact('fields'));
    }

    function loginPage()
    {
        // $accountIds = Account::pluck('id')->toArray();
        // $randomKey = array_rand($accountIds);
        // $randomId = $accountIds[$randomKey];
        // echo $randomId; // Output the random ID

        // foreach ($accountIds as $id) {
        //     echo $id . "<br>";
        // }
        $fields = $this->getFormFields('login', 'fields');
        return view('frontend.login', compact('fields'));
    }

    function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required | email |unique:users,email,except,id',
            'password' => 'required |confirmed',
        ]);

        $user = User::create([
            'id' => Str::uuid()->toString(),
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        if ($user) {
            return redirect('/login');
        } else {
            return "failed to Register Try Again";
        }
    }

    function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required | email',
            'password' => 'required',
        ]);

        if (Auth::attempt($data)) {
            return redirect('/admin/dashboard');
        } else {
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ])->withInput($request->except('password'));
        }
    }

    function dashboard()
    {
        if (Auth::check()) {
            $accountsCount = Account::count();
            $contactsCount = Contact::count();
            return view('dashboard.dashboard')->with([
                'accountsCount' => $accountsCount,
                'contactsCount' => $contactsCount
            ]);
        } else {
            return redirect('/login');
        }
    }


    function logout()
    {
        Auth::logout();
        $fields = $this->getFormFields('login', 'fields');
        return view('frontend.login', compact('fields'));
    }
}
