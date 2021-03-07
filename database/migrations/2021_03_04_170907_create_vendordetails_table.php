<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendordetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendordetails', function (Blueprint $table) {
            $table->bigIncrements('pki_vendordetail_id');
            $table->bigInteger('fki_vendor_id')->unsigned();
            $table->bigInteger('fki_project_id')->unsigned();
            $table->bigInteger('fki_status_id')->unsigned()->default(0);
            $table->bigInteger('fki_industrytype_id')->unsigned()->nullable();
            $table->string('cpi');
            $table->string('loi')->nullable();
            $table->string('ir')->nullable();
            $table->string('hits')->default(0);
            $table->string('required_completes');
            $table->string('completes')->default(0);
            $table->string('complete_url')->nullable();
            $table->string('disqualify_url')->nullable();
            $table->string('quotafull_url')->nullable();
            $table->string('quality_term_url')->nullable();
            $table->dateTime('created');
            $table->dateTime('updated');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vendordetails');
    }
}
