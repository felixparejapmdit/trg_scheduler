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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->enum('event_type', ['Meeting', 'Birthday & Anniversary', 'Non-Office']);
            $table->dateTime('event_datetime');
            $table->string('title');
            $table->text('description')->nullable();
            $table->text('incharge');
            $table->integer('prepared_by');
            $table->enum('status', ['active', 'completed', 'cancelled'])->default('active');
            $table->enum('priority', ['low', 'medium', 'high'])->default('medium');
            $table->enum('recurring', ['none', 'daily', 'weekly', 'monthly'])->default('none');
            $table->timestamps();
        });
        
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
