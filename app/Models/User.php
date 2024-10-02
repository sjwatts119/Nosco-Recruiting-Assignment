<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'role',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * One user has many agreements.
     *
     * @return HasMany
     */
    public function agreements() : HasMany
    {
        return $this->hasMany(Agreement::class, 'created_by');
    }

    /**
     * Does the user have the owner role?
     *
     * @return bool
     */
    public function isOwner() : bool
    {
        return $this->role === 'owner';
    }

    /**
     * Does the user have the staff role?
     *
     * @return bool
     */
    public function isStaff() : bool
    {
        return $this->role === 'staff';
    }

    /**
     * Get the number of agreement items this user has processed in all of their agreements.
     *
     * @return int
     */
    public function getTotalItemsCount(): int
    {
        return $this->agreements->sum(function($agreement) {
            return $agreement->getTotalItemsCount();
        });
    }

    /**
     * Get the total cost of all agreement items this user has processed in all of their agreements.
     *
     * @return int
     */
    public function getTotalCostPrice(): int
    {
        return $this->agreements->sum(function($agreement) {
            return $agreement->getTotalCostPrice();
        });
    }

    /**
     * Get the total retail cost of all agreement items this user has processed in all of their agreements.
     *
     * @return int
     */
    public function getTotalRetailPrice(): int
    {
        return $this->agreements->sum(function($agreement) {
            return $agreement->getTotalRetailPrice();
        });
    }
}
