<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUsersTableInsertMoreContactInfos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('neighborhood')->nullable();
            $table->string('number')->nullable();
            $table->string('telephone')->nullable();
            $table->string('cell')->nullable();
            $table->string('occupation')->nullable();
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
            $table->dropColumn('neighborhood');
            $table->dropColumn('occupation');
            $table->dropColumn('number');
            $table->dropColumn('telephone');
            $table->dropColumn('cell');
        });
    }
}
