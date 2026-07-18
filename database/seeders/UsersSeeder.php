<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        // Additional admin
        User::firstOrCreate(
            ['email' => 'admin@ghanadirect.com'],
            [
                'name'              => 'Samuel Adjei',
                'password'          => Hash::make('password'),
                'role'              => 'admin',
                'email_verified_at' => now(),
            ]
        );

        // Business owners
        $businessOwners = [
            ['name' => 'Kwame Asante',     'email' => 'kwame@kentegh.com'],
            ['name' => 'Akosua Mensah',    'email' => 'akosua@ghanaspices.com'],
            ['name' => 'Kofi Boateng',     'email' => 'kofi@accrafresh.com'],
            ['name' => 'Abena Amponsah',   'email' => 'abena@kurofa.com'],
            ['name' => 'Yaw Darko',        'email' => 'yaw@darkotech.com'],
            ['name' => 'Nana Osei Bonsu',  'email' => 'nana@oseilogistics.com'],
            ['name' => 'Efua Aidoo',       'email' => 'efua@akarasweets.com'],
            ['name' => 'Kwesi Armah',      'email' => 'kwesi@armahfarms.com'],
            ['name' => 'Adwoa Nyarko',     'email' => 'adwoa@nyarkofashion.com'],
            ['name' => 'Fiifi Antwi',      'email' => 'fiifi@antwirealty.com'],
        ];

        foreach ($businessOwners as $owner) {
            User::firstOrCreate(
                ['email' => $owner['email']],
                [
                    'name'              => $owner['name'],
                    'password'          => Hash::make('password'),
                    'role'              => 'business_owner',
                    'email_verified_at' => now(),
                ]
            );
        }

        // Reviewers / regular users
        $reviewers = [
            ['name' => 'Maame Afua Baah',  'email' => 'maame.baah@email.com'],
            ['name' => 'Elikem Tetteh',    'email' => 'elikem.tetteh@email.com'],
            ['name' => 'Patience Owusu',   'email' => 'patience.owusu@email.com'],
            ['name' => 'Godfred Agyei',    'email' => 'godfred.agyei@email.com'],
            ['name' => 'Ama Dankwa',       'email' => 'ama.dankwa@email.com'],
            ['name' => 'Bernard Asiedu',   'email' => 'bernard.asiedu@email.com'],
            ['name' => 'Abigail Quaye',    'email' => 'abigail.quaye@email.com'],
            ['name' => 'Emmanuel Frimpong','email' => 'emmanuel.frimpong@email.com'],
        ];

        foreach ($reviewers as $reviewer) {
            User::firstOrCreate(
                ['email' => $reviewer['email']],
                [
                    'name'              => $reviewer['name'],
                    'password'          => Hash::make('password'),
                    'role'              => 'reviewer',
                    'email_verified_at' => now(),
                ]
            );
        }
    }
}
