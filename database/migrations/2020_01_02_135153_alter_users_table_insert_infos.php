<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUsersTableInsertInfos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->text('description')->nullable();
            $table->dateTime('date_of_birth')->nullable();
            $table->string('age')->nullable();
            $table->string('zipcode')->nullable();
            $table->string('street')->nullable();
            $table->string('complement')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('description');
            $table->dropColumn('date_of_birth');
            $table->dropColumn('age');
            $table->dropColumn('zipcode');
            $table->dropColumn('street');
            $table->dropColumn('complement');
            $table->dropColumn('city');
            $table->dropColumn('state');
        });
    }
}
