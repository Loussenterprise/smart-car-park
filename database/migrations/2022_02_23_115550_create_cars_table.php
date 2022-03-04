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
            $table->timestamp("deleted_at")->nullable();
            $table->text('description')->nullable();
            $table->char('image', 255)->nullable();
            $table->char('name', 100)->nullable();
            $table->char('type', 100)->nullable();
            $table->boolean('free')->default(true);
            $table->integer('popularite')->default(0);
            $table->integer('nbrsiege')->default(0);
            $table->integer('nbrroue')->default(0);

            $table->decimal('width',10,2)->default(0);
            $table->decimal('length',10,2)->default(0);
            $table->decimal('height',10,2)->default(0);
            $table->decimal('prix',10,2)->default(0);
            $table->decimal('consombyhr',10,2)->default(0);

            $table->dateTime('token_at')->nullable();
            $table->integer('duration')->default("1");
            $table->dateTime('free_at')->nullable();
            $table->foreignId('user_id')->nullable()->constrained();
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
        Schema::dropIfExists('cars');
    }
};
