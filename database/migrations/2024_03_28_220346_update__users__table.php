useruser<?php

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
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->nullable();
            $table->string('surname')->nullable();
            $table->string('patronymic')->nullable();
            $table->date('birthday')->nullable();
            $table->string('sms_code')->nullable();
            $table->boolean('sms_verified')->default(false);


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('phone');
            $table->dropColumn('surname');
            $table->dropColumn('patronymic');
            $table->dropColumn('photo');
            $table->dropColumn('documents');
            $table->dropColumn('sms_code');
            $table->dropColumn('sms_verified');
        });
    }
};
