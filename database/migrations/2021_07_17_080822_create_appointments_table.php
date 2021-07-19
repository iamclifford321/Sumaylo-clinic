<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->string('doctor_id');
            $table->string('user_id');
            $table->string('appointmentName');
            $table->date('appointmentDate');
            $table->string('dateRange');
            $table->time('appointmentTime');
            $table->string('userStatus');
            $table->string('doctorStatus');
            $table->string('appointmentStatus');
            $table->text('Reason');
            $table->timestamps();

            $table->index('doctor_id');
            $table->index('user_id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appointments');
    }
}
