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
        Schema::create('websites', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('url');
            $table->string('traffic');
            $table->string('da');
            $table->float('dr')->nullable();
            $table->string('spam');
            $table->string('trafficsprint');
            $table->integer('niche');
            $table->string('contact');
            $table->string('email');
            $table->integer('user_id');
            $table->timestamps();
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('websites');
    }
};
