<?php

namespace Database\Seeders;

use App\Models\Agreement;
use App\Models\AgreementItem;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->count(10)->create([
            'role' => 'staff',
        ]);

        User::factory()->create([
            'name' => 'Staff User',
            'role' => 'staff',
            'email' => 'staff@example.com',
        ]);

        User::factory()->create([
            'name' => 'Owner User',
            'role' => 'owner',
            'email' => 'owner@example.com',
        ]);

        // Make between 1 and 10 agreements for each staff member
        User::where('role', 'staff')->get()->each(function ($staff) {
            Agreement::factory()->count(rand(1,10))->create([
                'created_by' => $staff->id,
            ]);

            // Make between 1 and 5 agreement items for each agreement
            $staff->agreements->each(function ($agreement) {
                AgreementItem::factory()->count(rand(1,5))->create([
                    'agreement_id' => $agreement->id,
                ]);
            });
        });
    }
}
