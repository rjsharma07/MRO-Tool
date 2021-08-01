<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeviceColumnToVendorprojectdetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vendorprojectdetails', function (Blueprint $table) {
            $table->string('device')->nullable()->after('ip');
            $table->string('city')->nullable()->after('device');
            $table->string('country')->nullable()->after('city');
            $table->string('zip')->nullable()->after('country');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vendorprojectdetails', function (Blueprint $table) {
            $table->dropColumn('device');
            $table->dropColumn('city');
            $table->dropColumn('country');
            $table->dropColumn('zip');
        });
    }
}
