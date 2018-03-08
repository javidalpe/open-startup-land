<?php

use App\Metric;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMetricsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('metrics', function (Blueprint $table) {
            $table->increments('id');
            $table->integer(Metric::MONTHLY_REVENUE);
            $table->integer(Metric::PAID_USERS);
            $table->integer(Metric::FREE_USERS);
            $table->date('recorded_at');
            $table->integer('startup_id')->unsigned();
            $table->foreign('startup_id')->references('id')->on('startups');
            $table->unique(['startup_id', 'recorded_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('metrics');
    }
}
