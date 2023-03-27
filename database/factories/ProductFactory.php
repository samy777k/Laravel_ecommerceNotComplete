<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;
use App\Models\Store;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->words(5 , true);
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'discription' => $this->faker->sentence(15),
            'image' => $this->imageUrl,
            //اول باراميتر هو الخانة العشرية
            //الثاني اصغر رقم
            //الثالث اكبر رقم
            'price' => $this->randomFloat(1 , 1 , 499),
            'compare_price' => $this->randomFloat(1 , 500 , 999),
            //روح عجدول الكاتيجوري رتبهم عشوائيا وهتلي اول اي دي
            'featured' => rand(0,1),
            'category_id' => Category::inRandomOrder()->first()->id,
            'store_id' => Store::inRandomOrder()->first()->id,
        ];
    }
}
