<?php

return [
    //relationship for Contact and Account Model
    'account_contact' => [
        'model' => App\Models\Contact::class,
        'type' => 'hasMany',
        'foreign_key' => 'account_id',
        'local_key' => 'id',
    ],
    'contact_account' => [
        'model' => App\Models\Account::class,
        'type' => 'belongsTo',
        'foreign_key' => 'account_id',
        'local_key' => 'id',
    ],

    ///////////////////////////////////////////////////////////////

    'contact_profile' => [
        'model' => App\Models\Profile::class,
        'type' => 'hasOne',
        'foreign_key' => 'contact_id',
        'local_key' => 'id',
    ],
    'profile_contact' => [
        'model' => App\Models\Contact::class,
        'type' => 'belongsTo',
        'foreign_key' => 'contact_id',
        'local_key' => 'id',
    ],
    /////////////////////////////////////////////////////////////

    // Many-to-Many relationship for Contact and Tag Model
    'contact_tag' => [
        'model' => App\Models\Tag::class,
        'type' => 'belongsToMany',
        'pivot_table' => 'contact_tag',
        'foreign_key' => 'contact_id',
        'related_key' => 'tag_id',
        'local_key' => 'id',
        'related_local_key' => 'id',
    ],

    'tag_contact' => [
        'model' => App\Models\Contact::class,
        'type' => 'belongsToMany',
        'pivot_table' => 'contact_tag',
        'foreign_key' => 'tag_id',
        'related_key' => 'contact_id',
        'local_key' => 'id',
        'related_local_key' => 'id',
    ],
];
