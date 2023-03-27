<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinishOrder extends Model
{
    use HasFactory;
    protected $table = 'finish_orders';

    protected $fillable = [
        'order_id' , 'product_name' , 'quantity' , 'category' , 'store_name' , 'store_id'
    ];

    // public function category(){
    //     return $this->belongsTo(Category::class , 'category' , 'id');
    // }

    public function order(){
        $this->belongsTo(Order::class , 'order_id' , 'id');
    }

   

}
