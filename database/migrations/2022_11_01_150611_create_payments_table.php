<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->enum('status', payStatuses()->all())->default('Pendiente');
            $table->unsignedFloat('amount')->nullable();
            $table->string('ref')->nullable();
            $table->enum('type', payTypes()->all())->nullable();
            $table->enum('category', payCategories()->all());
            $table->boolean('fulfilled')->default(true);
            $table->foreignId('enrollment_id')->constrained();
            $table->softDeletes();
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
        Schema::dropIfExists('payments');
    }
}
