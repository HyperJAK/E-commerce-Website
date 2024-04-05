<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $primaryKey = 'payment_id';
    protected $fillable = ['payment_method_id','amount_paid','payment_status_id', 'order_id', 'date'];

    public function getPaymentMethod()
    {
        return $this->hasOne(PaymentMethod::class,'payment_method_id', 'payment_method_id');
    }

    public function getPaymentStatus()
    {
        return $this->hasOne(PaymentStatus::class,'payment_status_id', 'payment_status_id');
    }

    public function getPaymentOrder()
    {
        return $this->hasOne(Order::class,'order_id', 'order_id');
    }


}
