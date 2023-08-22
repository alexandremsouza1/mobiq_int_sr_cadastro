<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientPreferencesTable extends Migration
{
    public function up()
    {
        Schema::create('client_preferences', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->json('notification_preferences');
            $table->timestamps();

            // Adicionar chave estrangeira para cliente
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('client_preferences');
    }
}
