<?php

namespace Tests\Feature;

use App\Livewire\AddAgreementItem;
use App\Livewire\NewAgreement;
use App\Models\Agreement;
use App\Models\AgreementItem;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class AgreementItemCreationTest extends TestCase
{
    /**
     * Ensure the user can add an item to an agreement.
     */
    public function test_required_validation_of_agreement_item_creation()
    {
        $user = User::factory()->staff()->create();
        $this->actingAs($user);

        Livewire::test(AddAgreementItem::class)
            ->set('name', '')
            ->set('description', '')
            ->set('quantity', '')
            ->set('cost_price', '')
            ->set('retail_price', '')
            ->call('addItem')
            ->assertHasErrors([
                'name' => 'required',
                'description' => 'required',
                'quantity' => 'required',
                'cost_price' => 'required',
                'retail_price' => 'required',
            ]);
    }

    /**
     * Ensure money fields are validated correctly.
     */
    public function test_money_fields_validate_decimal_places()
    {
        // Should try every variation of decimal places, from none to 3, it should accept 2, fail 3, and fail 4
        $user = User::factory()->staff()->create();
        $this->actingAs($user);

        Livewire::test(AddAgreementItem::class)
            ->set('name', 'Product 1')
            ->set('description', 'Product 1 description')
            ->set('quantity', 1)
            ->set('cost_price', 10)
            ->set('retail_price', 20)
            ->call('addItem')
            ->assertHasNoErrors();

        Livewire::test(AddAgreementItem::class)
            ->set('name', 'Product 1')
            ->set('description', 'Product 1 description')
            ->set('quantity', 1)
            ->set('cost_price', 10.1)
            ->set('retail_price', 20.5)
            ->call('addItem')
            ->assertHasNoErrors();

        Livewire::test(AddAgreementItem::class)
            ->set('name', 'Product 1')
            ->set('description', 'Product 1 description')
            ->set('quantity', 1)
            ->set('cost_price', 10.12)
            ->set('retail_price', 20.53)
            ->call('addItem')
            ->assertHasNoErrors();

        Livewire::test(AddAgreementItem::class)
            ->set('name', 'Product 2')
            ->set('description', 'Product 2 description')
            ->set('quantity', 1)
            ->set('cost_price', 10.234)
            ->set('retail_price', 20.272)
            ->call('addItem')
            ->assertHasErrors([
                'cost_price' => 'decimal:0,2',
                'retail_price' => 'decimal:0,2',
            ]);
    }

    /**
     * Ensure the quantity field is validated correctly.
     */
    public function test_quantity_fields_are_validated()
    {
        // Should accept 1, fail 0, and fail -1
        $user = User::factory()->staff()->create();
        $this->actingAs($user);

        Livewire::test(AddAgreementItem::class)
            ->set('name', 'Product 1')
            ->set('description', 'Product 1 description')
            ->set('quantity', 1)
            ->set('cost_price', 10)
            ->set('retail_price', 20)
            ->call('addItem')
            ->assertHasNoErrors();

        Livewire::test(AddAgreementItem::class)
            ->set('name', 'Product 1')
            ->set('description', 'Product 1 description')
            ->set('quantity', 0)
            ->set('cost_price', 10)
            ->set('retail_price', 20)
            ->call('addItem')
            ->assertHasErrors(['quantity' => 'min']);

        Livewire::test(AddAgreementItem::class)
            ->set('name', 'Product 1')
            ->set('description', 'Product 1 description')
            ->set('quantity', -1)
            ->set('cost_price', 10)
            ->set('retail_price', 20)
            ->call('addItem')
            ->assertHasErrors(['quantity' => 'min']);
    }
}
