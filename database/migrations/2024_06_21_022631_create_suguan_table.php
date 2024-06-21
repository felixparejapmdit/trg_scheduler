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
        Schema::create('suguan', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('lokal');
            $table->string('district');
            $table->dateTime('suguan_datetime');
            $table->string('gampanin');
            $table->integer('prepared_by')->nullable();
            $table->text('comments')->nullable();
            $table->timestamps();
        });
        
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suguan');
    }
};
