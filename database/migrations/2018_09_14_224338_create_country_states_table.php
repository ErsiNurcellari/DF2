<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountryStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('sortname', 3);
            $table->string('name', 150);
            $table->integer('phonecode');
        });
        
        Schema::create('states', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 30);
            $table->bigInteger('country_id')->default(1);
        });

        $path = Storage::disk('local')->getAdapter()->getPathPrefix();

        Eloquent::unguard();

        $sql = $path.'countries.sql';
        DB::unprepared(file_get_contents($sql));
//        $this->command->info('Country table seeded!');

        $sql = $path.'states.sql';
        DB::unprepared(file_get_contents($sql));
//        $this->command->info('States table seeded!');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('countries');
        Schema::dropIfExists('states');
    }
}
