<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->id();
            $table->string('phone_number',20);
            $table->string('id_card_name', 20);
            $table->string('id_card_number', 30);
            $table->string('gender', 5);
            $table->string('current_address',100);
            $table->integer('channel_id');
            $table->string('device', 10);
            $table->smallInteger('login_status');
            $table->string('bank_card_number', 30);
            $table->string('bank_account', 50);
            $table->string('family_relationship',10);
            $table->string('family_name', 10);
            $table->string('family_phone_number', 20);
            $table->string('friend_relationship', 10);
            $table->string('friend_name', 10);
            $table->string('friend_phone_number',20);
            $table->string('work_experience', 30);
            $table->integer('work_income');
            $table->string('work_address', 50);
            $table->string('loan_way',20);
            $table->string('password',30);
            $table->smallInteger('status');
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
        Schema::dropIfExists('user');
    }
}