<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'division_id',
        'district_id',
        'state_id',
        'name',
        'phone',
        'email',
        'post_code',
        'notes',
        'payment_type',
        'payment_method',
        'transaction_id',
        'currency',
        'amount',
        'order_number',
        'invoice_no',
        'order_date',
        'order_month',
        'order_year',
        'confirmed_date',
        'processing_date',
        'picked_date',
        'shipped_date',
        'delivered_date',
        'cancel_date',
        'return_date',
        'return_reason',
        'status',
        'return_order',
    ];
    public function division(){
        return $this->belongsTo(ShipDivision::class,'division_id','id');
    }
    public function district(){
        return $this->belongsTo(ShipDistrict::class,'district_id','id');
    }
    public function state(){
        return $this->belongsTo(ShipState::class,'state_id','id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
   
}
