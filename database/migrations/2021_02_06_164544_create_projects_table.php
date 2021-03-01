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
            $table->id();
            $table->string('name')->unique();;
            $table->string('client');
            $table->string('subject');
            $table->string('type');
            $table->bigInteger('ir');
            $table->bigInteger('loi');
            $table->float('cpi');
            $table->string('currency');
            $table->string('survey_link');
            $table->bigInteger('required_completes');
            $table->string('complete')->unique();
            $table->string('disqualify')->unique();
            $table->string('quotafull')->unique();
            $table->string('qualityteam')->unique();
            $table->integer('fki_security_id')->default(1);
            $table->timestamps();
            $table->boolean('status')->default(1);
            $table->index(['name']);
            $table->foreign('fki_security_id')
                    ->references('pki_security_id')
                    ->on('securitychecks')
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
        Schema::dropIfExists('projects');
    }
}
