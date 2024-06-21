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
        Schema::create('reminders', function (Blueprint $table) {
            $table->id();
            $table->dateTime('reminder_datetime');
            $table->text('reminder');
            $table->integer('week_number');
            $table->text('verse_of_the_week');
            $table->text('incharge');
            $table->integer('prepared_by');
            $table->enum('status', ['active', 'completed', 'cancelled'])->default('active');
            $table->enum('priority', ['low', 'medium', 'high'])->default('medium');
            $table->timestamps();
        });
        
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reminders');
    }
};
