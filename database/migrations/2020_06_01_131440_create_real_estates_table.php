<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRealEstatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('real_estates', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->string('category');
            $table->string('address');
            $table->unsignedBigInteger('price');
            $table->unsignedInteger('bedroom');
            $table->unsignedInteger('bathroom');
            $table->unsignedInteger('wc');
            $table->unsignedInteger('area');
            $table->text('description');
            $table->string('slug')->unique()->index();
            $table->timestamps();
        });

        Schema::create('equipment_real_estate', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('equipment_id')->index();
            $table->unsignedInteger('real_estate_id')->index();
            $table->foreign('equipment_id')->references('id')->on('equipments')->onDelete('cascade');
            $table->foreign('real_estate_id')->references('id')->on('real_estates')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('equipment_real_estate');
        Schema::dropIfExists('real_estates');
    }
}
