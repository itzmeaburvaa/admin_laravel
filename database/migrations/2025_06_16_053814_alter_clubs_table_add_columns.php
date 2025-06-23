<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('club', function (Blueprint $table) {
            $table->string('club_name')->nullable();
            $table->string('logo_path')->nullable();
            $table->text('introduction')->nullable();
            $table->string('staff_coordinator')->nullable();
            $table->string('staff_email')->nullable();
            $table->string('year_start')->nullable();
        });
    }

    public function down()
    {
        Schema::table('club', function (Blueprint $table) {
            $table->dropColumn([
                'cname',
                'logo',
                'intro',
                'mission',
                'faculty',
                'facultyno',
                'teamno',
                'eventno',
                'participants',
                'year'
            ]);
        });
    }
};


