<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedInteger('job_issuer_rank')->nullable();
            $table->string('job_title')->nullable();
            $table->unsignedInteger('issue_type')->nullable();
            $table->unsignedInteger('job_type')->nullable();
            $table->float('job_price')->nullable();
            $table->unsignedInteger('job_worker')->nullable();
            $table->unsignedInteger('job_visibility')->nullable();
            $table->longText('job_description')->nullable();
            $table->integer('job_status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_posts');
    }
}
