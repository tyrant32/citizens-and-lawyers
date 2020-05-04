<?php
declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

/**
 * Class CreateаppointmentsTable.
 */
class CreateаppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('аppointments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id', false, true)->nullable();
            $table->integer('lawyer_id', false, true)->nullable();
            $table->integer('status_id', false, true)->nullable();
            $table->dateTime('time');
            $table->timestamps();
            
            $table->foreign('user_id')
                ->references('id')
                ->on('users');
            
            $table->foreign('lawyer_id')
                ->references('id')
                ->on('users');
            
            $table->foreign('status_id')
                ->references('id')
                ->on('appointments_statuses');
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('аppointments');
    }
}
