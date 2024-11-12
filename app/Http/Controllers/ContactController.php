<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\ContactTag;
use App\Models\Profile;
use Illuminate\Support\Str;
use App\Traits\DynamicFormTrait;
use App\Models\Tag;

class ContactController extends Controller
{
    use DynamicFormTrait;
    public function index()
    {
        $contacts = Contact::with('account')->get(); // Eager load 'account' with each contact
        return view('contacts.contacts', ['contacts' => $contacts]);
    }


    function create()
    {
        $fields = $this->getFormFields('contacts', 'create');
        $accounts = Account::all();
        $tags = Tag::all();
        return view('contacts.addContact', compact('fields', 'accounts', 'tags'));
    }

    function store(Request $request)
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

    return redirect('/contacts')->with('success', 'New Contact Created Successfully!');
}

    function show($id)
    {
        $contact = Contact::with(['account', 'profile', 'tag'])->find($id); // Fetch contact along with its related account
        if (!$contact) {
            return redirect()->back()->with('error', 'Contact not found.');
        }
        return view('contacts.details', compact('contact'));
    }

    function edit($id)
    {
        $fields = $this->getFormFields('contacts', 'edit');
        $contact = Contact::find($id);
        $accounts = Account::all();
        return view('contacts.editContact', compact('fields', 'contact', 'accounts'));
    }

    function update($id, Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:191',
            'phone' => 'required|string|max:191',
            'account_id' => 'required|exists:accounts,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $contact = Contact::find($id);
        $contact->name = $request->name;
        $contact->phone = $request->phone;
        $contact->account_id = $request->account_id;
        $contact->image = $request->image;

        $fielName = time() . "Contact_Image." . $request->file('image')->getClientOriginalExtension();
        $request->file('image')->storeAs('public/images', $fielName);
        $contact->save();
        return redirect('/contacts');
    }

    function destroy($id)
    {
        $contact = Contact::find($id);
        if ($contact->delete($id)) {
            return redirect('/contacts')->with('message', 'The contact has been moved to Trash');
        } else {
            return "failed to delete the Contact";
        }
    }

    function trashed()
    {
        $contacts = Contact::onlyTrashed()->get();
        return view('contacts.trashed', compact('contacts'));
    }

    function forceDelete($id)
    {
        $contact = Contact::withTrashed()->find($id);  // Use withTrashed() to allow for soft-deleted records

        if (!$contact) {
            return redirect('/contacts/trashed')->with('error', 'Contact not found or already permanently deleted!');
        }

        $contact->forceDelete(); // Permanently delete the contact
        return redirect('/contacts/trashed')->with('message', 'Contact Deleted Permanently!');
    }


    function restore($id)
    {
        $Contact = Contact::withTrashed()->findOrFail($id);
        $Contact->restore();
        return redirect()->route('contact.trashed')->with('message', 'Contact restored successfully');
    }
}
