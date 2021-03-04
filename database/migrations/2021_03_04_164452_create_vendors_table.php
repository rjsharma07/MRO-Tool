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
            $table->bigInteger('fki_country_id');
            $table->bigInteger('fki_currency_id')->nullable();
            $table->string('vendor', 150)->unique();
            $table->string('reference_name')->nullable();
            $table->dateTime('created');
            $table->dateTime('updated');
            $table->boolean('active')->default(1);
            $table->index(['fki_country_id']);
            $table->foreign('fki_country_id')
                    ->references('pki_country_id')
                    ->on('countries')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
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
