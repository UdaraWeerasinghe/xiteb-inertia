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
        Schema::create('prescriptions', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('added_by');
            $table->foreign('added_by')->references('id')->on('users');

            $table->string('note')->nullable();
            $table->string('delivery_address');
            $table->date('delivery_date');
            $table->string('delivery_time_slot', 20);

            $table->tinyInteger('status')->nullable()->comment('0 - reject, 1 - accept, 2 - quotation sent ');
            
            $table->unsignedBigInteger('issued_by')->nullable();
            $table->foreign('issued_by')->references('id')->on('users');

            $table->decimal('amount',10,2)->nullable();
            $table->timestamp('issued_at')->nullable();

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
        Schema::dropIfExists('prescriptions');
    }
};
