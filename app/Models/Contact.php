<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Log;
use App\Traits\HasDynamicRelationships;

class Contact extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasDynamicRelationships;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'name',
        'phone',
        'account_id',
        'image',
    ];

    protected static function boot()
    {
        parent::boot();

        // Event: Before creating a new contact
        static::creating(function ($contact) {
            Log::info('Creating a new contact:', ['name' => $contact->name, 'phone' => $contact->phone]);
        });

        // Event: After creating a new contact
        static::created(function ($contact) {
            Log::info('Contact created successfully:', ['id' => $contact->id, 'name' => $contact->name]);
        });

        // Event: Before updating a contact
        static::updating(function ($contact) {
            Log::info('Updating contact:', ['id' => $contact->id, 'name' => $contact->name]);
        });

        // Event: After updating a contact
        static::updated(function ($contact) {
            Log::info('Contact updated successfully:', ['id' => $contact->id, 'name' => $contact->name]);
        });

        // Event: Before deleting a contact
        static::deleting(function ($contact) {
            Log::info('Deleting contact:', ['id' => $contact->id, 'name' => $contact->name]);
        });

        // Event: After deleting a contact
        static::deleted(function ($contact) {
            Log::info('Contact deleted successfully:', ['id' => $contact->id, 'name' => $contact->name]);
        });

        // Event: After restoring a contact
        static::restored(function ($contact) {
            Log::info('Contact restored successfully:', ['id' => $contact->id, 'name' => $contact->name]);
        });
    }
    public function account()
    {
        return $this->dynamicRelationship('contact_account');
    }

    public function profile()
    {
        return $this->dynamicRelationship('contact_profile');
    }

    public function tag()
    {
        return $this->dynamicRelationship('contact_tag');
        // return $this->belongsToMany(Tag::class, 'contact_tag', 'contact_id', 'tag_id');
    }
}
