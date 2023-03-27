<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected static function booted(){
        static::addGlobalScope('store' , function(Builder $builder){
        $user = Auth::user();
        if($user){
        if($user->store_id){
            $builder->where('store_id' , '=' , $user->store_id);
        }
    }
        });
    }

    //relationship with category
    public function category(){
       return $this->belongsTo(Category::class , 'category_id' , 'id')->withDefault();
    }

    public function store(){
        return $this->belongsTo(Store::class , 'store_id' , 'id')->withDefault();
    }

    //Accessors :
    //يتم تعريف الاكسسور لما اكون بدي اعمل شرط على اتربيوت جاي من الداتا بيز
    //ال ايماج يو ار ال هاي المتغيرة الباقي ثابت لازم احطو
    public function getImageUrlAttribute(){
        //الذيس تؤشر على المودل نفسو كاني بحكي :
        //Product->image
        if(!$this->image){
            return 'https://cdn.sanity.io/images/0vv8moc6/dermatologytimes/d198c3b708a35d9adcfa0435ee12fe454db49662-640x400.png?fit=crop&auto=format';
        }else{
            return asset('storage/'. $this->image);
        }
    }

    public function getDiscountPriceAttribute(){
        if(!$this->compare_price){
            return 0 ;
        }else{
          return round(100 - (100*$this->price / $this->compare_price)) . '%';
        }
    }


}
