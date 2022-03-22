<?php

use App\Models\city;
use App\Models\patient;
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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('f_name');
            $table->string('l_name');
            $table->string('mobile');
            $table->enum('gender', ['F', 'M']);
            $table->date('birth_date');
            $table->string('ensurance_num');
            $table->string('national_num');
            $table->boolean('active')->default(false);
            $table->string('email');
            $table->string('password');
            $table->timestamps();
            $table->foreignIdFor(city::class)->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patients');
    }
};
