<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorprojectdetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendorprojectdetails', function (Blueprint $table) {
            $table->bigIncrements('pki_vendorprojectdetail_id');
            $table->bigInteger('fki_project_id')->unsigned();
            $table->bigInteger('fki_status_id')->unsigned()->nullable();
            $table->bigInteger('fki_vendordetail_id')->unsigned();
            $table->string('vendor_respondent_id');
            $table->string('respondent_id');
            $table->string('ip')->nullable();
            $table->dateTime('entered')->nullable();
            $table->dateTime('exited')->nullable();
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
        Schema::dropIfExists('vendorprojectdetails');
    }
}
