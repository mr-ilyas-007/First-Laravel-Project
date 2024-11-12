<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    function home()
    {
        return view('dashboard.home');
    }

    function profile($id)
    {
        $user = User::find($id);
        return view('dashboard.profile', compact('user'));
    }

    function settings()
    {
        return view('dashboard.settings');
    }

    public function updateProfile(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|max:255|unique:users,email,'. Auth::id(),
        ]);

        $user = User::find($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->save();
        return redirect("/profile/$user->id")->with('status', 'Profile updated successfully.');
    }

    public function updateSettings(Request $request)
    {
        return redirect('settings')->with('status', 'Settings saved successfully.');
    }
}
