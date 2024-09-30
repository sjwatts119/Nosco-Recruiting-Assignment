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
}
