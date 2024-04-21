<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'user_id';

    //disabled the timestamp so laravel avoid excepting created_time and updated_at
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'address',
        'country',
        'city',
        'is_seller'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
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
            'is_seller' => 'boolean'
        ];
    }

    public function getStores(){
        return $this->hasMany(Store::class);
    }

    public function getCart(){
        return $this->hasOne(Cart::class, 'cart_id', 'cart_id');
    }
    public function getWishlist(){
        return $this->hasMany(Wishlist::class, 'wishlist_id', 'wishlist_id');
    }
}
