<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTokenBuyHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('token_buy_history', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('user_email');
            $table->string('txref');
            $table->float('amountsettledforthistransaction', 9, 2);
            $table->float('appfee', 9, 2);
            $table->tinyInteger('verified')->default(0);
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
        Schema::dropIfExists('token_buy_history');
    }
}
