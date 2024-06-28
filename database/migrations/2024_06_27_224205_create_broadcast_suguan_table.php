<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBroadcastSuguanTable extends Migration
{
    public function up()
    {
        Schema::create('broadcast_suguan', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('name');
            $table->string('tobebroadcast');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('broadcast_suguan');
    }
}
