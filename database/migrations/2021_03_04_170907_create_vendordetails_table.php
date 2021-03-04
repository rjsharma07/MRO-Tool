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
            $table->bigInteger('fki_vendor_id');
            $table->bigInteger('fki_project_id');
            $table->bigInteger('fki_status_id')->default(0);
            $table->bigInteger('fki_industrytype_id')->nullable();
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
            $table->index(['fki_vendor_id']);
            $table->foreign('fki_vendor_id')
                    ->references('pki_vendor_id')
                    ->on('vendors')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->index(['fki_project_id']);
            $table->foreign('fki_project_id')
                    ->references('pki_project_id')
                    ->on('projects')
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
        Schema::dropIfExists('vendordetails');
    }
}
