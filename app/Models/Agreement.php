<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agreement extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'customer_forename',
        'customer_surname',
        'customer_date_of_birth',
        'created_by',
    ];

    /**
     * One agreement has many agreement items.
     *
     * @return HasMany
     */
    public function agreementItems() : HasMany
    {
        return $this->hasMany(AgreementItem::class);
    }

    /**
     * An agreement belongs to a user.
     *
     * @return BelongsTo
     */
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the full name of the customer.
     *
     * @return string
     */
    public function getFullCustomerName() : string
    {
        return $this->customer_forename . ' ' . $this->customer_surname;
    }

    /**
     * Get a friendly formatted date of birth.
     *
     * @return string
     */
    public function getFormattedDateOfBirth() : string
    {
        return date('d/m/Y', strtotime($this->customer_date_of_birth));
    }

    /**
     * Get the number of agreement items related to this agreement.
     *
     * @return int
     */
    public function getTotalItemsCount() : int
    {
        return $this->agreementItems->sum('quantity');
    }

    /**
     * Get the total cost of all agreement items related to this agreement.
     *
     * @return string
     */
    public function getTotalCostPrice() : string
    {
        return '£' . number_format($this->agreementItems->sum(function ($item) {
            return $item->cost_price * $item->quantity;
        }), 2);
    }

    /**
     * Get the total retail price of all agreement items related to this agreement.
     *
     * @return string
     */
    public function getTotalRetailPrice() : string
    {
        return '£' . number_format($this->agreementItems->sum(function ($item) {
            return $item->retail_price * $item->quantity;
        }), 2);
    }

    /**
     * Void this agreement, and all associated items.
     *
     * @return void
     */
    public function void() : void
    {
        $this->voided_at = now();
        $this->save();

        // For every item associated with this, set voided_at to now
        $this->agreementItems->each(function ($item) {
            $item->void();
        });
    }

    /**
     * Unvoid this agreement, and all associated items.
     *
     * @return void
     */
    public function unvoid() : void
    {
        $this->voided_at = null;
        $this->save();

        // For every item associated with this, set voided_at to null
        $this->agreementItems->each(function ($item) {
            $item->unvoid();
        });
    }

}
