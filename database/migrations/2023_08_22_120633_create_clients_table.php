<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('document'); // CNPJ ou CPF
            $table->string('password'); // password_hash('sua senha aqui', 1)
            $table->string('clientId');
            $table->string('businessCategory'); // Desc_Canal
            $table->string('name');
            $table->string('sector'); // ConsultarSetores
            $table->string('status'); // active, blocked, review, dbClient, noRegister, confirmation, company, logistic, partner, documents
            $table->integer('category'); // 1 - 5

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
