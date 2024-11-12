<?php
// config/form_fields.php
return [
    'login' => [
        'fields' => [
            ['type' => 'email','name' => 'email', 'label' => 'Email Address', 'validation' => 'required|email'],
            ['type' => 'password','name' => 'password', 'label' => 'Password', 'validation' => 'required'],
        ],
    ],
    'register' => [
        'fields' => [
            'name' => ['type' => 'text', 'label' => 'Name', 'validation' => 'required|string|max:255'],
            'email' => ['type' => 'email', 'label' => 'Email Address', 'validation' => 'required|email|unique:users,email'],
            'password' => ['type' => 'password', 'label' => 'Password', 'validation' => 'required|confirmed|min:6'],
            'password_confirmation' => ['type' => 'password', 'label' => 'Confirm Password'],
        ],
    ],
    'contacts' => [
        'create' => [
            ['type' => 'text', 'name' => 'name', 'label' => 'Contact Name', 'required' => true],
            ['type' => 'text', 'name' => 'phone', 'label' => 'Phone Number', 'required' => true],
            ['type' => 'file', 'name' => 'image', 'label' => 'Upload Image', 'required' => true],
            ['type' => 'text', 'name' => 'address', 'label' => 'Enter Address', 'required' => true],
            ['type' => 'date', 'name' => 'date_of_birth', 'label' => 'Enter Date of Birth', 'required' => true],
            ['type' => 'select', 'name' => 'account_id', 'label' => 'Company Name', 'options' => 'accounts', 'required' => true],
            ['type' => 'checkbox', 'name' => 'tags[]', 'label' => 'Assign Tags', 'options' => 'tags'],
        ],
        'edit' => [
            ['type' => 'text', 'name' => 'name', 'label' => 'Contact Name', 'required' => true],
            ['type' => 'text', 'name' => 'phone', 'label' => 'Phone Number', 'required' => true],
            ['type' => 'text', 'name' => 'address', 'label' => 'Enter Your Address', 'required' => true],
            ['type' => 'date', 'name' => 'date_of_birth', 'label' => 'Enter Your Date of Birth', 'required' => true],
            ['type' => 'file', 'name' => 'image', 'label' => 'Upload Your Image', 'required' => true],
            ['type' => 'select', 'name' => 'account_id', 'label' => 'Company Name', 'options' => 'accounts', 'required' => true],
            ['type' => 'checkbox', 'name' => 'tags[]', 'label' => 'Assign Tags', 'options' => 'tags'],
        ],
    ],
    'accounts' => [
        'create' => [
            ['type' => 'text', 'name' => 'company_name', 'label' => 'Company Name', 'required' => true],
            ['type' => 'textarea', 'name' => 'address', 'label' => 'Address', 'required' => true],
            ['type' => 'number', 'name' => 'pin_code', 'label' => 'Pin Code', 'required' => true],
        ],
        'edit' => [
            ['type' => 'text', 'name' => 'company_name', 'label' => 'Company Name', 'required' => true],
            ['type' => 'textarea', 'name' => 'address', 'label' => 'Address', 'required' => true],
            ['type' => 'number', 'name' => 'pin_code', 'label' => 'Pin Code', 'required' => true],
        ],
    ],
    'users' => [
        'create' => [
            ['type' => 'text', 'name' => 'name', 'label' => 'Name', 'required' => true],
            ['type' => 'email', 'name' => 'email', 'label' => 'Email Address', 'required' => true],
            ['type' => 'password', 'name' => 'password', 'label' => 'Password', 'required' => true],
            ['type' => 'password', 'name' => 'password_confirmation', 'label' => 'Confirm Password', 'required' => true],
        ],
        'edit' => [
            ['type' => 'text', 'name' => 'name', 'label' => 'Name', 'required' => true],
            ['type' => 'email', 'name' => 'email', 'label' => 'Email', 'required' => true],
        ],
    ],
];


