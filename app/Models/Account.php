<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Log;
use App\Traits\HasDynamicRelationships;

class Account extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasDynamicRelationships;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'company_name',
        'address',
        'pin_code'
    ];

    protected static function boot()
    {
        parent::boot();

        // Event: Before creating a new account
        static::creating(function ($account) {
            Log::info('Creating a new account:', ['company_name' => $account->company_name, 'contact_email' => $account->contact_email]);
        });

        // Event: After creating a new account
        static::created(function ($account) {
            Log::info('Account created successfully:', ['id' => $account->id, 'company_name' => $account->company_name]);
        });

        // Event: Before updating an account
        static::updating(function ($account) {
            Log::info('Updating account:', ['id' => $account->id, 'company_name' => $account->company_name]);
        });

        // Event: After updating an account
        static::updated(function ($account) {
            Log::info('Account updated successfully:', ['id' => $account->id, 'company_name' => $account->company_name]);
        });

        // Event: Before deleting an account
        static::deleting(function ($account) {
            Log::info('Deleting account:', ['id' => $account->id, 'company_name' => $account->company_name]);
        });

        // Event: After deleting an account
        static::deleted(function ($account) {
            Log::info('Account deleted successfully:', ['id' => $account->id, 'company_name' => $account->company_name]);
        });

        // Event: After restoring an account
        static::restored(function ($account) {
            Log::info('Account restored successfully:', ['id' => $account->id, 'company_name' => $account->company_name]);
        });
    }
    public function contact()
    {
        return $this->dynamicRelationship('account_contact');
    }
}
