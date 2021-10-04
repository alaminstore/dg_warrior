<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewColumnToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedInteger('manager_task_access')->nullable();
            $table->string('company_name')->nullable();
            $table->date('birth_date')->nullable();
            $table->text('address')->nullable();
            $table->string('city')->nullable();
            $table->string('zipcode')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->unsignedInteger('subscription')->nullable();
            $table->unsignedInteger('completed_job')->nullable();
            $table->timestamp('last_login')->nullable();
            $table->float('balance')->nullable();
            $table->float('withdrawable')->nullable();
            $table->float('waiting_load_balance')->nullable();
            $table->string('waiting_load_code')->nullable();
            $table->unsignedInteger('exp')->nullable();
            $table->unsignedInteger('level')->nullable();
            $table->double('sales_achieved')->nullable();
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
            //
        });
    }
}
