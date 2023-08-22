<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartnersTable extends Migration
{
    public function up()
    {
        Schema::create('partners', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id');
            $table->string('firstName');
            $table->string('lastName');
            $table->string('cpf');
            $table->date('birthday')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // Adicionar chave estrangeira para empresa
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('partners');
    }
}
