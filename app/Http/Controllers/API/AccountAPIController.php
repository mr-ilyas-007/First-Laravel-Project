<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Account;
use Illuminate\Http\Request;
use Stringable;
use Illuminate\Support\Str;

class AccountAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Account::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'company_name' => 'required|max:191',
            'address' => 'required|max:191',
            'pin_code' => 'required|numeric',
        ]);

        $account = new Account();
        $account->id = Str::uuid()->toString();
        $account->company_name = $request->company_name;
        $account->address = $request->address;
        $account->pin_code = $request->pin_code;
        $account->created_at = now();
        $account->updated_at = now();
        $account->save();
        return response()->json(['result' => 'account created successfully!', 'data'=>$account->all()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $account = Account::find($id);
        return response()->json(['Account' => '$account']);
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
        $request->validate([
            'company_name' => 'required|max:191',
            'address' => 'required|max:191',
            'pin_code' => 'required|numeric',
        ]);

        $account = Account::find($id);
        $account->company_name = $request->company_name;
        $account->address = $request->address;
        $account->pin_code = $request->pin_code;
        $account->updated_at = now();
        $account->save();
        return response()->json(['result' => 'account updated successfully!', 'data' => $account], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $account = Account::find($id);
        $account->delete();
        return response()->json(['result'=>'account id:',$account->id,' Moved to Trash Successfully!', 'data'=>Account::all()], 200);
    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    function trashed()
    {
        $account = Account::onlyTrashed()->get();
        return response()->json(['hello'=>'user']);
    }

    function restore($id)
    {
        $account = Account::withTrashed()->findOrFail($id);
        $account->restore();
        return response()->json(['result' => 'Account ' . $account->company_name . ' Restored Successfully!', 'data'=>Account::all()], 200);
    }

    function forceDelete($id)
    {
        $account = Account::withTrashed()->findOrFail($id);
        $account->forceDelete(); // Permanently deletes the record
        return response()->json(['result' => 'Account ' . $account->company_name . ' Permanently Deleted Successfully!', 'data'=>Account::all()], 200);
    }
}
