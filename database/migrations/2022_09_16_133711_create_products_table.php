<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->string('language')->nullable();
            $table->string('category')->nullable();
            $table->longText('list_price')->nullable();
            $table->longText('price')->nullable();
            $table->bigInteger('quantity')->nullable();
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->string('seo_name')->nullable();
            $table->text('short')->nullable();
            $table->char('status')->nullable();
            $table->string('vendor')->nullable();
            $table->text('features')->nullable();
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
};
