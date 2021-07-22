<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_history', function (Blueprint $table) {
            $table->id();
            $table->integer('wallet_id')->index('wallet_id');
            $table->integer('user_id')->index('user_id');
            $table->decimal('amount', 8, 8);
            $table->string('receiver_address')->index('receiver_address');
            $table->string('address_type',10);
            $table->string('transaction_hash')->nullable();
            $table->tinyInteger('transaction_type');
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
        Schema::dropIfExists('transaction_history');
    }
}
