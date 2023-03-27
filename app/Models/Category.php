<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;
use Illuminate\Database\Eloquent\Builder;

class Category extends Model
{
    use HasFactory,SoftDeletes;

    //يتم تخزين الحقول الموجودين هنا فقطط
    // protected $fillable = [
    //     'name' , 'parent_id' , 'discription' , 'image' , 'status' , 'slug'
    // ];

    //هان اسم الحقل الي بحطو هنا ممنوع ينبعت بالريكويست يعني مش هيتخزن
    // protected $guarded = [
    //     'id'
    // ];

//local scope------------------------
    public function scopeFilter(Builder $builder , $request){
        if($request['name'] ?? false){
            $builder->where('categories.name' , 'LIKE' , "%{$request['name']}%");

        }
        if($request['status'] ?? false){
            $builder->where('categories.status' , $request['status']);

        }
    }

    // relation with product
    public function product(){
        return $this->hasMany(Product::class , 'category_id' , 'id');
    }

}
