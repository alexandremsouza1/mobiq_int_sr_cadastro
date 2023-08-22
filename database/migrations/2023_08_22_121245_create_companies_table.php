<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('responsible_id');
            $table->string('cpfCnpj');
            $table->string('socialName');
            $table->string('fantasyName');
            $table->string('address'); // Você pode usar um campo json ou relacionamento
            $table->string('businessKey');
            $table->string('ecNumber');
            $table->string('merchantId');
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('responsible_id')->references('id')->on('responsibles');
        });
    }

    public function down()
    {
        Schema::dropIfExists('companies');
    }
}
