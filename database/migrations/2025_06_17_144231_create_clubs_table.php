<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('club', function (Blueprint $table) {
    $table->id();
    $table->string('club_name');
    $table->string('logo_path');
    $table->text('introduction');
    $table->string('staff_coordinator');
    $table->string('staff_email');
    $table->year('year_start');
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('club');
    }
    
};
