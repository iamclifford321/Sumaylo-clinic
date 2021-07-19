<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
          $table->id();
          $table->string('firstName');
          $table->string('lastName');
          $table->string('middleName');
          $table->string('street');
          $table->string('barangay');
          $table->string('zip');
          $table->string('city');
          $table->string('province');
          $table->string('Phone');
          $table->string('gender');
          $table->text('profile');
          $table->integer('age');
          $table->date('dateOfBirth');
          $table->text('medicalHistory')->nullable();
          $table->text('username');
          $table->text('type');
          $table->string('email')->unique();
          $table->string('password')->nullable();
          $table->rememberToken();
          $table->timestamps();
        });


        DB::table('users')->insert([
          'firstName' => 'admin',
          'lastName' => 'admin',
          'middleName' => 'admin',
          'street' => 'Test',
          'barangay' => 'Test',
          'zip' => 'Test',
          'city' => 'Test',
          'province' => 'Test',
          'Phone' => 'Test',
          'gender' => 'Test',
          'profile' => 'Test',
          'age' => 22,
          'dateOfBirth' => '1998-10-10',
          'username' => 'admin@test.com',
          'type' => '0',
          'email' => 'admin@test.com',
          'password' => Hash::make('admin')
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
