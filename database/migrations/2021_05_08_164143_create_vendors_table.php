<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->bigIncrements('pki_vendor_id');
            $table->bigInteger('fki_country_id')->unsigned()->nullable();
            $table->bigInteger('fki_currency_id')->unsigned()->nullable();
            $table->string('vendor', 150)->unique();
            $table->string('email', 191)->nullable();
            $table->string('phone', 12)->nullable();
            $table->text('billing_address')->nullable();
            $table->text('complete_url')->nullable();
            $table->text('disqualify_url')->nullable();
            $table->text('quotafull_url')->nullable();
            $table->text('quality_term_url')->nullable();
            $table->dateTime('created');
            $table->dateTime('updated');
            $table->boolean('active')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vendors');
    }
}
