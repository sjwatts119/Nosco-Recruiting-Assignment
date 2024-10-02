<?php

namespace Tests\Feature;

use App\Livewire\NewAgreement;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class PurchaseAgreementCreationTest extends TestCase
{
    /**
     * Ensure that a staff member can create a purchase agreement.
     */
    public function test_staff_member_can_create_purchase_agreement()
    {
        $user = User::factory()->staff()->create();
        $this->actingAs($user);

        Livewire::test(NewAgreement::class)
            ->set('customerForename', 'John')
            ->set('customerSurname', 'Doe')
            ->set('customerDateOfBirth', '01/01/2000')
            ->call('addItem', [
                'name' => 'Product 1',
                'description' => 'Product 1 description',
                'quantity' => 1,
                'cost_price' => 10.00,
                'retail_price' => 20.00,
            ])
            ->call('addItem', [
                'name' => 'Product 2',
                'description' => 'Product 2 description',
                'quantity' => 2,
                'cost_price' => 15.00,
                'retail_price' => 25.00,
            ])
            ->call('newPurchaseAgreement');

        $this->assertDatabaseHas('agreements', [
            'customer_forename' => 'John',
            'customer_surname' => 'Doe',
            'customer_date_of_birth' => '2000-01-01',
            'created_by' => $user->id,
        ]);

        $this->assertDatabaseHas('agreements', [
            'customer_forename' => 'John',
            'customer_surname' => 'Doe',
            'customer_date_of_birth' => '2000-01-01',
            'created_by' => $user->id,
        ]);

        $items = [
            [
                'name' => 'Product 1',
                'description' => 'Product 1 description',
                'quantity' => 1,
                'cost_price' => 10.00,
                'retail_price' => 20.00,
            ],
            [
                'name' => 'Product 2',
                'description' => 'Product 2 description',
                'quantity' => 2,
                'cost_price' => 15.00,
                'retail_price' => 25.00,
            ],
        ];

        foreach ($items as $item) {
            $this->assertDatabaseHas('agreement_items', $item);
        }
    }

    /**
     * Ensure that an owner can create a purchase agreement.
     */
    public function test_owner_can_create_purchase_agreement()
    {
        $user = User::factory()->owner()->create();
        $this->actingAs($user);

        Livewire::test(NewAgreement::class)
            ->set('customerForename', 'John')
            ->set('customerSurname', 'Doe')
            ->set('customerDateOfBirth', '01/01/2000')
            ->call('addItem', [
                'name' => 'Product 1',
                'description' => 'Product 1 description',
                'quantity' => 1,
                'cost_price' => 10.00,
                'retail_price' => 20.00,
            ])
            ->call('addItem', [
                'name' => 'Product 2',
                'description' => 'Product 2 description',
                'quantity' => 2,
                'cost_price' => 15.00,
                'retail_price' => 25.00,
            ])
            ->call('newPurchaseAgreement');

        $this->assertDatabaseHas('agreements', [
            'customer_forename' => 'John',
            'customer_surname' => 'Doe',
            'customer_date_of_birth' => '2000-01-01',
            'created_by' => $user->id,
        ]);

        $items = [
            [
                'name' => 'Product 1',
                'description' => 'Product 1 description',
                'quantity' => 1,
                'cost_price' => 10.00,
                'retail_price' => 20.00,
            ],
            [
                'name' => 'Product 2',
                'description' => 'Product 2 description',
                'quantity' => 2,
                'cost_price' => 15.00,
                'retail_price' => 25.00,
            ],
        ];

        foreach ($items as $item) {
            $this->assertDatabaseHas('agreement_items', $item);
        }
    }

    /**
     * Ensure that the date of birth is required.
     */
    public function test_customer_date_of_birth_is_required()
    {
        $user = User::factory()->staff()->create();
        $this->actingAs($user);

        Livewire::test(NewAgreement::class)
            ->set('customerForename', 'John')
            ->set('customerSurname', 'Doe')
            ->call('newPurchaseAgreement')
            ->assertHasErrors(['customerDateOfBirth' => 'required']);
    }

    /**
     * Ensure that the date of birth must be a valid date.
     */
    public function test_customer_date_of_birth_must_be_a_valid_date()
    {
        $user = User::factory()->staff()->create();
        $this->actingAs($user);

        Livewire::test(NewAgreement::class)
            ->set('customerForename', 'John')
            ->set('customerSurname', 'Doe')
            ->set('customerDateOfBirth', 'invalid-date')
            ->call('newPurchaseAgreement')
            ->assertHasErrors(['customerDateOfBirth' => 'date_format']);
    }

    /**
     * Ensure that the customer's forename is required.
     */
    public function test_customer_forename_is_required()
    {
        $user = User::factory()->staff()->create();
        $this->actingAs($user);

        Livewire::test(NewAgreement::class)
            ->set('customerSurname', 'Doe')
            ->set('customerDateOfBirth', '01/01/2000')
            ->call('newPurchaseAgreement')
            ->assertHasErrors(['customerForename' => 'required']);
    }

    /**
     * Ensure that the customer's surname is required.
     */
    public function test_customer_surname_is_required()
    {
        $user = User::factory()->staff()->create();
        $this->actingAs($user);

        Livewire::test(NewAgreement::class)
            ->set('customerForename', 'John')
            ->set('customerDateOfBirth', '01/01/2000')
            ->call('newPurchaseAgreement')
            ->assertHasErrors(['customerSurname' => 'required']);
    }

    /**
     * Ensure that at least one item must be added to the agreement.
     */
    public function test_at_least_one_item_must_be_added_to_the_agreement()
    {
        $user = User::factory()->staff()->create();
        $this->actingAs($user);

        Livewire::test(NewAgreement::class)
            ->set('customerForename', 'John')
            ->set('customerSurname', 'Doe')
            ->set('customerDateOfBirth', '01/01/2000')
            ->call('newPurchaseAgreement')
            ->assertHasErrors(['items' => 'You must add at least one item to the agreement.']);
    }
}
