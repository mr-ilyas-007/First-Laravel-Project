<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'contact_id',
        'address',
        'date_of_birth',
    ];

    public function contact()
    {
        return $this->dynamicRelationship('contact_profile');
    }
}
