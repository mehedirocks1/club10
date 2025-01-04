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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('name', 191)->nullable();
            $table->string('email', 191)->nullable();
            $table->string('phone', 60)->nullable();
            $table->double('amount')->default(0);
            $table->text('address')->nullable();
            $table->string('status', 20)->default('Pending');
            $table->string('transaction_id', 191);
            $table->string('currency', 20)->default('BDT');
            // User-related information
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('bangla_name')->nullable();
            $table->string('photo')->nullable();
            $table->string('mobile_number')->nullable();
            $table->date('dob')->nullable();
            $table->string('nid')->nullable();
            $table->string('gender')->nullable();
            $table->string('blood_group')->nullable();
            $table->string('education')->nullable();
            $table->string('profession')->nullable();
            $table->string('skills')->nullable();
            $table->string('password')->nullable();
            $table->string('country')->nullable();
            $table->string('division')->nullable();
            $table->string('district')->nullable();
            $table->string('thana')->nullable();
            $table->string('membership_type')->nullable();
            
            // Adding user_id column (nullable if the user is not required)
            $table->unsignedBigInteger('user_id')->nullable();
            
            // Foreign key constraint for user_id
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            
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
};
