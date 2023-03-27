<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id( );
            //constrained for make relationship and determine what the table make referance
            $table->foreignId('parent_id')->nullable()->constrained('categories' , 'id')
            ->nullOnDelete();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('discription')->nullable();
            $table->string('image')->nullable();
            $table->enum('status' , ['active' , 'archived'])->default('active');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
