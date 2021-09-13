<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Account;
use App\Models\Contact;
use App\Models\Organization;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $account = Account::create(['name' => 'ZUUPEE Corporation']);

        $user = User::factory()->create([
            // 'first_name' => 'John',
            // 'last_name' => 'Doe',
            'name' => 'Mohsin Shaikh',
            'email' => 'mohsin.shaikh@zuupee.com',
            'account_id' => $account->id,
            'owner' => true,
        ]);

        $user::factory()->withPersonalTeam();

        User::factory(5)->create(['account_id' => $account->id]);

        $organizations = Organization::factory(100)->create(['account_id' => $account->id]);

        Contact::factory(100)->create(['account_id' => $account->id])->each(function ($contact) use ($organizations) {
            $contact->update(['organization_id' => $organizations->random()->id]);
        });
    }
}
