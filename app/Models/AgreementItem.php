<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class AgreementItem extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'agreement_id',
        'name',
        'description',
        'quantity',
        'cost_price',
        'retail_price',
    ];

    /**
     * An agreement item belongs to an agreement.
     * @return BelongsTo
     */
    public function agreement() : BelongsTo
    {
        return $this->belongsTo(Agreement::class);
    }
}
