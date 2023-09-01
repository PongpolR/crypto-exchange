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
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignIdFor(\App\Models\User::class);
            $table->foreignIdFor(\App\Models\User::class, 'with_user_id');
            $table->foreignIdFor(\App\Models\Cryptocurrency::class);
            $table->timestamps();
        });

        // Schema::table('transactions',function (Blueprint $table){
        //   $table->foreign('with_user_id')->references('id')->on('users');
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
