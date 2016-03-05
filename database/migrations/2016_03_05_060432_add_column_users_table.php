<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('company_id')->after('remember_token')->unsigned()->comment('회사ID')
            $table->enum('client_yn',   array('Y', 'N'))->default('Y')->after('remember_token')->comment('Y:client,   N:not client');
            $table->enum('salesman_yn', array('Y', 'N'))->default('N')->after('remember_token')->comment('Y:salesman, N:not salesman');
            $table->enum('admin_yn',    array('Y', 'N'))->default('N')->after('remember_token')->comment('Y:admin,    N:not admin');
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
            $table->dropColumn('company_id');
            $table->dropColumn('client_yn');
            $table->dropColumn('salesman_yn');
            $table->dropColumn('admin_yn');
        });
    }
}
