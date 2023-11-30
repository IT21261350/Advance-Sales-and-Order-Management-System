<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'orderCode',
        'cName',
        'pProduct',
        'order_date',
        'order_time',
        'price',
        'discountLimit',
        'discount',
        'quantity',
        'freeQty',
        'totalAmt'
    ];

}
