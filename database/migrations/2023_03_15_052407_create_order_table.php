<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->smallInteger('audit_result');
            $table->decimal('apply_amount');
            $table->integer('apply_period');
            $table->decimal('approved_amount');
            $table->decimal('withdraw_amount');
            $table->smallInteger('withdraw_status');
            $table->smallInteger('withdraw_button');
            $table->dateTime('withdraw_time');
            $table->smallInteger('contract');
            $table->string('app_status',10);
            $table->text('app_remarks');
            $table->smallInteger('status');
            $table->integer('SMS');
            $table->decimal('insurance_amount');
            $table->integer('regulatory_ratio');
            $table->text('process_result');
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
        Schema::dropIfExists('orders');
    }
}
