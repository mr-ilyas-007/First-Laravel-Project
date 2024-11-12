<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasDynamicRelationships;

class Tag extends Model
{
    use HasFactory;
    use HasDynamicRelationships;

    public $incrementing = false;
    protected $keyType = 'string';

    public function contact()
    {
        return $this->dynamicRelationship('tag_contact');
        // return $this->belongsToMany(Contact::class, 'contact_tag', 'tag_id', 'contact_id');
    }
}
