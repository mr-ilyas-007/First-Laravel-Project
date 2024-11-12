<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Traits\DynamicFormTrait;

class AccountController extends Controller
{
    use DynamicFormTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accounts = Account::all();
        // if(Auth::user()->is_admin == 1){
        //     return view("accounts.index", ['accounts' => $accounts]);
        // }
        return view("accounts.index", compact('accounts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $fields = $this->getFormFields('accounts', 'create');
        return view('accounts.create', compact('fields'));
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
            'company_name' => 'required',
            'address' => 'required',
            'pin_code' => 'required',
        ]);

        Account::create([
            'id' => Str::uuid()->toString(),
            'company_name' => $data['company_name'],
            'address' => $data['address'],
            'pin_code' => $data['pin_code'],
        ]);
        return redirect()->route('accounts.index')->with('message', 'New Account Addes successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $account = Account::with('contact')->find($id);
        if (!$account) {
            return redirect('/contacts')->with('error', 'Account not found');
        }   
        return view('accounts.details', ['account' => $account]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $fields = $this->getFormFields('accounts', 'edit');
        $account = Account::findOrFail($id);
        // if(Auth::user()->is_admin == 1){
        //     return view('admin-dashboard.Accounts.edit', ['account' => $account]);
        // }
        view('dashboard.home')->with('message', 'Acccount Updated Successfully!');

        return view('accounts.edit', compact('account', 'fields'));

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
            'company_name' => 'required',
            'address' => 'required',
            'pin_code' => 'required',
        ]);

        $account = Account::findOrFail($id);
        $account->company_name = $request->company_name;
        $account->address = $request->address;
        $account->pin_code = $request->pin_code;
        $account->save();
        return redirect()->route('accounts.index')->with('message', 'Account Updated Successfilly!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $account = Account::findOrFail($id);
        $account->delete();
        return redirect()->route('accounts.index')->with('message', 'Account Deleted Successfully!');
    }

    function trashed()
    {
        $account = Account::onlyTrashed()->get();
        return view('accounts.trashed', compact('account'));
    }

    public function restore($id)
    {
        $account = Account::withTrashed()->findOrFail($id);
        $account->restore();
        return redirect()->route('accounts.index')->with('message', 'Account restored successfully');
    }

    public function forceDelete($id)
    {
        $account = Account::withTrashed()->findOrFail($id);
        $account->forceDelete(); // Permanently deletes the record
        return redirect()->route('accounts.index')->with('message', 'Account permanently deleted');
    }
}
