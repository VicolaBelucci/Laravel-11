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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('title', 30)->nullable(false);
            $table->string('description', 255);

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id') 
                ->references('id')   
                ->on('users')        
                ->onDelete('cascade'); 
            
            $table->unsignedBigInteger('related_id')->nullable();
            $table->foreign('related_id') 
                ->references('id')       
                ->on('tasks')            
                ->onDelete('cascade');  

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};