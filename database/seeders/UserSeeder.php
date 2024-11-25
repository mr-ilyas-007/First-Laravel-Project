<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\Contact;
use App\Models\Profile;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $numer= 5;
        // $tags = \App\Models\Tag::factory()->count(4)->create();
        $faker = \Faker\Factory::create();
        // for ($i = 0; $i < $numer; $i++) {
        $userID = Str::uuid()->toString();
        User::create([
            'id' => $userID,
            'name' => $faker->name(),
            'email' => $faker->unique()->safeEmail,
            'password' => bcrypt('123'),
            'is_admin' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // $accountID = Str::uuid()->toString();
        // Account::create([
        //     'id' => $accountID,
        //     'company_name' => $faker->company,
        //     'address' => $faker->address,
        //     'pin_code' => $faker->postcode,
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ]);

        $accountIds = Account::pluck('id')->toArray(); // here i am converting the collection to array
        $randomKey = array_rand($accountIds); // getting a random key
        $randomId = $accountIds[$randomKey]; // get the corresponding id of the key
        // echo $randomId;
        $contactID = Str::uuid()->toString();
        $contact = Contact::create([
            'id' => $contactID,
            'name' => $faker->name(),
            'phone' => $faker->phoneNumber(),
            'account_id' => $randomId,
            'image' => $faker->imageUrl(640, 480, 'people', true, 'Faker'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // $tags = \App\Models\Tag::factory()->count(5)->create();
        $tags = \App\Models\Tag::all();
        $contact->tag()->attach(
            $tags->random(rand(2, Tag::count()))->pluck('id')->toArray()
        );

        // $contactIds = Contact::pluck('id')->toArray();
        // $contactRandomKey = array_rand($contactIds);
        // $randomContactID = $contactIds[$contactRandomKey];
        Profile::create([
            'id' => Str::uuid()->toString(),
            'contact_id' => $contact['id'],
            'address' => $faker->address(),
            'date_of_birth' => $faker->date($format = 'Y-m-d', $max = '2007-12-31'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // }
    }
}
