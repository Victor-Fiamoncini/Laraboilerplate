<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('admin');
            $table->unsignedInteger('company');
            $table->enum('role', ['admin', 'employee'])->default('employee');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('cover')->nullable();
            $table->string('github_id')->unique()->nullable();
            $table->string('google_id')->unique()->nullable();
            $table->dateTime('last_login_at')->nullable();
            $table->string('last_login_ip')->nullable();
            $table->timestamps();
            $table
                ->foreign('admin')
                ->references('id')
                ->on('users')
                ->onDelete('CASCADE');
            $table
                ->foreign('company')
                ->references('id')
                ->on('companies')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->dropIfExists('employees');
        });
    }
}
