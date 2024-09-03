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
        Schema::table('orders', function (Blueprint $table) {
            $table->string('time')->after('city');
            $table->string('realization')->after('time');
            $table->string('street')->after('realization')->nullable();
            $table->integer('house_number')->after('street')->nullable();
            $table->string('zip_code')->after('house_number')->nullable();
            $table->integer('apartment_number')->after('zip_code')->nullable();
            $table->string('floor')->after('apartment_number')->nullable();
            $table->string('payment_delivery')->after('floor');
            $table->text('note')->after('payment_delivery')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('time');
            $table->dropColumn('realization');
            $table->dropColumn('street');
            $table->dropColumn('house_number');
            $table->dropColumn('zip_code');
            $table->dropColumn('apartment_number');
            $table->dropColumn('floor');
            $table->dropColumn('payment_delivery');
            $table->dropColumn('note');
        });
    }
};
