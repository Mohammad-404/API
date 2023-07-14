<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CustomerpaymentDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customerpayment', function (Blueprint $table) {
            $table->id();
            $table->string('customer_id');
            $table->string('card_no');
            $table->string('card_expire');
            $table->string('code');
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
        Schema::dropIfExists('customerpayment');
    }
}
