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
        Schema::dropIfExists('cars');
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->timestamp("deleted_at")->nullable();
            $table->char('image', 255)->nullable();
            $table->char('name', 100)->nullable();
            $table->boolean('free')->default(true);
            $table->integer('popularite')->default(0);
            $table->integer('nbrsiege')->default(0);
            $table->integer('nbrroue')->default(0);

            $table->decimal('width',5,5)->default(0);
            $table->decimal('length',5,5)->default(0);
            $table->decimal('height',5,5)->default(0);
            $table->decimal('prix',5,5)->default(0);
            $table->decimal('consombyhr',5,5)->default(0);

            $table->dateTime('token_at', $precision = 0)->nullable();
            $table->time('duration')->default("00:00:00");
            $table->dateTime('free_at', $precision = 0)->nullable();
//             $table->enum('type', ['salle', 'projecteur', 'portable'])->nullable();
            $table->foreignId('user_id')->nullable()->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cars');
    }
};
