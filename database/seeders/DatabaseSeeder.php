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
        // Make 10 staff members
        User::factory()->count(10)->create([
            'role' => 'staff',
        ]);

        User::factory()->create([
            'name' => 'Test User',
            'role' => 'staff',
            'email' => 'test@example.com',
        ]);

        User::factory()->create([
            'name' => 'Owner User',
            'role' => 'owner',
            'email' => 'admin@example.com',
        ]);

        // Make between 0 and 5 agreements for each staff member
        User::where('role', 'staff')->get()->each(function ($staff) {
            Agreement::factory()->count(rand(1,10))->create([
                'created_by' => $staff->id,
            ]);

            // Make between 0 and 5 agreement items for each agreement
            $staff->agreements->each(function ($agreement) {
                AgreementItem::factory()->count(rand(1,5))->create([
                    'agreement_id' => $agreement->id,
                ]);
            });
        });
    }
}
