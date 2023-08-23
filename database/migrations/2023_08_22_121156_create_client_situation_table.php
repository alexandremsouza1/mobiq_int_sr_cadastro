<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientSituationTable extends Migration
{
    public function up()
    {
        Schema::create('client_situation', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->boolean('has_no_debt')->default(0);
            $table->string('debt')->nullable();
            $table->timestamps();

            // Adicionar chave estrangeira para cliente
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('client_situation');
    }
}
