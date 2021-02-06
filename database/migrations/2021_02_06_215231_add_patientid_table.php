<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPatientidTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('appointments', function (Blueprint $table) {
            
            $table->bigInteger('patient_id')->after('doctor_id')->nullable()->unsigned();
            
            $table->foreign('patient_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
