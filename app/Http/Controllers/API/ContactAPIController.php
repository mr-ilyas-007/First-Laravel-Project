<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Profile;
use App\Models\ContactTag;
use App\Models\Tag;

class ContactAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(['Contacts: '=>Contact::all()]);
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
            'name' => 'required|string|max:191',
            'phone' => 'required|string|max:191',
            'address' => 'required|string|max:191',
            'date_of_birth' => 'required|string|max:191',
            'account_id' => 'required|exists:accounts,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'tags' => 'array', // Validate tags as an array
            'tags.*' => 'exists:tags,id', // Validate that each tag ID exists in tags table
        ]);

        // Handle image upload if provided
        $fileName = null;
        if ($request->hasFile('image')) {
            $fileName = time() . "Contact_Image." . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->storeAs('public/images', $fileName);
        }

        // Create Contact
        $contact = Contact::create([
            'id' => Str::uuid()->toString(),
            'name' => $data['name'],
            'phone' => $data['phone'],
            'account_id' => $data['account_id'],
            'image' => $fileName,
        ]);

        // Create Profile linked to Contact
        Profile::create([
            'id' => Str::uuid()->toString(),
            'contact_id' => $contact->id,
            'address' => $data['address'],
            'date_of_birth' => $data['date_of_birth'],
        ]);

        // Attach Tags to Contact
        if (!empty($data['tags'])) {
            foreach ($data['tags'] as $tagId) {
                $contactTag = new ContactTag();
                $contactTag->contact_id = $contact->id;
                $contactTag->tag_id = $tagId;
                $contactTag->save();  // Save each tag relation
            }
        }

        return response()->json(['result'=>'New Contacts Created Successfully!', 'data'=>Contact::all()], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contact = Contact::with(['account', 'profile', 'tag'])->find($id); // Fetch contact along with its related account
        if (!$contact) {
            return response()->json(['error' => 'Contact not found.']);
        }
        return response()->json(['contact'=>['name'=>$contact->name, 'id'=>$contact->id, 'phone'=>$contact->phone, 'Company Name'=>$contact->account->company_name, 'Date of Birth'=>$contact->profile->date_of_birth, 'address'=>$contact->profile->address, 'tags'=>[explode(',',$contact->tag)]]], 200);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
