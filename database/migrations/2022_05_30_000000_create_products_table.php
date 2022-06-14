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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string("barcode", 100)->unique();
            $table->string("name", 100);
            $table->text("description")->nullable();
            $table->string("image");
            $table->unsignedTinyInteger("tax_percentage")->default(0);
            $table->decimal("tax", 10)->default(0);
            $table->unsignedTinyInteger("profit_percentage");
            $table->decimal("profit", 10);
            $table->decimal("gross_price", 10);
            $table->decimal("net_price", 10);
            $table->unsignedInteger("stock");
            $table->timestampsTz();
            $table->timestampTz("deleted_at");
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
