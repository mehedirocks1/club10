<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
 /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Create the users table with custom fields
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('bangla_name');
            $table->string('photo')->nullable();
            $table->string('email')->unique();
            $table->string('mobile_number');
            $table->date('dob');
            $table->string('nid');
            $table->enum('gender', ['Male', 'Female', 'Other']);
            $table->string('blood_group');
            $table->string('education');
            $table->string('profession');
            $table->string('skills')->nullable(); 
            $table->string('country')->nullable();
            $table->string('division')->nullable();
            $table->string('district')->nullable();
            $table->string('thana')->nullable();
            $table->text('address')->nullable();
            $table->string('membership_type')->nullable();
            $table->string('registration_fee')->nullable();
            $table->boolean('terms_accepted')->default(true);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->unsignedTinyInteger('role_id')->default(3); // Default role: 3 (User)
            $table->tinyInteger('status')->default(1);
            $table->rememberToken();
            $table->timestamps();
            $table->string('terms')->default('accepted');
        });
    
        // Create the password_reset_tokens table
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });
    
        // Create the sessions table
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the users table
        Schema::dropIfExists('users');

        // Drop the password_reset_tokens table
        Schema::dropIfExists('password_reset_tokens');

        // Drop the sessions table
        Schema::dropIfExists('sessions');
    }
};
