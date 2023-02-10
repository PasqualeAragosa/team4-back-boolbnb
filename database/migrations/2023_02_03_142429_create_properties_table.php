<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100)->unique();
            $table->string('slug');
            $table->float('price', 6, 2)->nullable();
            $table->tinyInteger('rooms_num')->nullable();
            $table->tinyInteger('beds_num')->nullable();
            $table->tinyInteger('baths_num')->nullable();
            $table->smallInteger('square_meters')->nullable();
            $table->string('address');
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->boolean('visibility')->default(0);
            $table->float('longitude', 8, 6)->nullable();
            $table->float('latitude', 8, 6)->nullable();
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
        Schema::dropIfExists('properties');
    }
};
