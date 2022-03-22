<?php

use App\Models\city;
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
        Schema::table('users', function (Blueprint $table) {
            //
            // $table->foreignId('city_id')->after('password');
            // $table->foreign('city_id')->on('cities')->references('id');
            // $table->foreignIdFor(city::class);
            // $table->foreign('city_id')->on('cities')->references('id');
            // $table->foreignId('city_id')->constrained();
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
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropForeign('users_city_id_foreign');
            $table->dropColumn('city_id');
        });
    }
};
