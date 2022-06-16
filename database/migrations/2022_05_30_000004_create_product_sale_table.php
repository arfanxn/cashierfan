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
        Schema::create('product_sale', function (Blueprint $table) {
            $table->id();
            $table->foreignId("sale_id")->constrained("sales", "id")->onDelete("cascade");
            $table->foreignId("product_id")->constrained("products", "id")->onDelete("cascade");

            $table->unsignedTinyInteger("tax_percentage")->default(0);
            $table->decimal("tax", 16)->default(0);
            $table->unsignedTinyInteger("profit_percentage")->default(0);
            $table->decimal("profit", 16);
            $table->decimal("gross_price", 16);
            $table->decimal("net_price", 16);

            $table->unsignedInteger("quantity")->default(1);
            $table->decimal('sum_tax', 16)->default(0);
            $table->decimal('sum_profit', 16);
            $table->decimal('sum_gross_price', 16);
            $table->decimal('sum_net_price', 16);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sale_details');
    }
};
