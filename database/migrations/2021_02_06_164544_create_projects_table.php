<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->bigIncrements('pki_project_id');
            $table->bigInteger('fki_client_id')->unsigned();
            $table->bigInteger('fki_user_id')->unsigned();
            $table->bigInteger('fki_country_id')->unsigned()->nullable();
            $table->bigInteger('fki_currency_id')->unsigned()->nullable();
            $table->bigInteger('fki_status_id')->unsigned()->default(0);
            $table->bigInteger('fki_industrytype_id')->unsigned()->nullable();
            $table->integer('fki_security_id')->unsigned()->default(1);
            $table->string('epo', 50)->unique();
            $table->string('name');
            $table->string('reference_name')->nullable();
            $table->string('subject');
            $table->string('type')->nullable();
            $table->bigInteger('ir')->nullable();
            $table->bigInteger('loi')->nullable();
            $table->float('cpi')->nullable();
            $table->bigInteger('hits')->default(0);
            $table->bigInteger('required_completes')->default(100);
            $table->bigInteger('completes')->default(0);
            $table->text('client_survey_url')->nullable();
            $table->text('complete_url')->nullable();
            $table->text('disqualify_url')->nullable();
            $table->text('quotafull_url')->nullable();
            $table->text('quality_term_url')->nullable();
            $table->dateTime('created');
            $table->dateTime('updated');
            $table->boolean('status')->default(1);
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
