<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('title')->nullable();
            $table->string('slug')->nullable();
            $table->string('type')->nullable()->default('service')->index();
            $table->text('description')->nullable();
            $table->bigInteger('user_id')->unsigned()->index();
            $table->string('status', 20)->default('publish')->index();
            $table->string('comment_status', 20)->default('open');
            $table->bigInteger('commment_count')->default(0);
            $table->string('price', 255)->default(0.0)->nullable();
            $table->bigInteger('form_id')->nullable();
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
        Schema::dropIfExists('products');
    }
}
