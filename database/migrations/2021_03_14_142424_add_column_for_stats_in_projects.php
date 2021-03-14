<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnForStatsInProjects extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->text('generated_survey_url')->nullable();
            $table->bigInteger('complete_count')->nullable();
            $table->bigInteger('disqualify_count')->nullable();
            $table->bigInteger('quality_term_count')->nullable();
            $table->bigInteger('quota_full_count')->nullable();
            $table->bigInteger('survey_visited_count')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn('generated_survey_url');
            $table->dropColumn('complete_count');
            $table->dropColumn('disqualify_count');
            $table->dropColumn('quality_term_count');
            $table->dropColumn('quota_full_count');
            $table->dropColumn('survey_visited_count');
        });
    }
}
