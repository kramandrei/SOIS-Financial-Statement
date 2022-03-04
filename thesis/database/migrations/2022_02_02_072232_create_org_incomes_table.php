<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrgIncomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('org_incomes', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->integer('org_id');
            $table->integer('income_id');
            $table->text('invoice_or');
            $table->text('receipt');
            $table->text('description');
            $table->integer('isApproved');
            $table->integer('approvedBy');
            $table->integer('createdBy');
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
        Schema::dropIfExists('org_incomes');
    }
}
