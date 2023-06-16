<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone_no')->nullable();
            $table->string('wallet_address')->nullable();
            $table->string('referral_code')->unique();
            $table->string('cnic')->nullable();
            $table->string('doc_type')->nullable();
            $table->string('doc_img')->nullable();
            $table->string('doc_img_1')->nullable();
            $table->longText('address')->nullable();
            $table->date('dob')->nullable();
            $table->boolean('is_admin')->default(false);
            $table->string('status')->default('pending');
            $table->float('initial_investment')->default(0);
            $table->integer('updated_by')->nullable();
            $table->string('referred_by')->nullable();
            $table->integer('level')->nullable();
            $table->tinyinteger('is_delete')->default(0);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
