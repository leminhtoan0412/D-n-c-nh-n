<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->foreign('account_id')->references('id')->on('accounts');
            $table->foreign('shipping_id')->references('id')->on('shippings');
        });

        Schema::table('invoice_details', function (Blueprint $table) {
            $table->foreign('invoice_id')->references('id')->on('invoices');
            $table->foreign('product_id')->references('id')->on('products');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('sub_category_id')->references('id')->on('sub_categories');
        });

        Schema::table('sub_categories', function (Blueprint $table) {
            $table->foreign('category_id')->references('id')->on('categories');
        });

        Schema::table('reviews', function (Blueprint $table) {
            $table->foreign('account_id')->references('id')->on('accounts');
            $table->foreign('product_id')->references('id')->on('products');
        });
        Schema::table('product_images', function (Blueprint $table) {
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
