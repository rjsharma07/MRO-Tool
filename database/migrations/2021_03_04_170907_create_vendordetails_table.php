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
            $table->text('survey_url');
            $table->float('cpi');
            $table->integer('loi')->nullable();
            $table->bigInteger('ir')->nullable();
            $table->bigInteger('hits')->default(0);
            $table->bigInteger('required_completes');
            $table->bigInteger('completes')->default(0);
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
        Schema::dropIfExists('vendordetails');
    }
}
