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
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->dateTime('token_at')->nullable();
            $table->integer('duration')->default("1");
            $table->dateTime('free_at')->nullable();
            $table->decimal('prix',10,2)->default(0);
            $table->foreignId('car_id')->nullable()->constrained();
            $table->foreignId('user_id')->nullable()->constrained();
            $table->boolean('closed')->nullable()->default(false);
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
        Schema::dropIfExists('locations');
    }
};
