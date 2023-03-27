<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;


class Order extends Model
{
    use HasFactory;


    protected $fillable =[
        'user_id' , 'first_name' , 'last_name' , 'email' , 'phone_number' ,
        'mail_address' , 'city' , 'country' , 'state' ,
        //  'product_name' ,
        // 'quantity' ,
        //  'category'
    ];

    // public function products(){
    //     $this->belongsToMany(Product::class,'order_products');
    // }

    public static function booted(){
        static::creating(function(Order $order){
            if(Auth::id()){
                $order->user_id = Auth::id();
            }else{
                $order->user_id = 0;
            }

        });
    }

    public function finishOrders(){
       return $this->hasMany(FinishOrder::class , 'order_id' , 'id');
    }

}
