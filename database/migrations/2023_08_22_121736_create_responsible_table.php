<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResponsiblesTable extends Migration
{
    public function up()
    {
        Schema::create('responsibles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address'); // Você pode usar um campo json ou relacionamento
            $table->date('birthday')->nullable();
            $table->string('email');
            $table->string('password');
            $table->string('cellphone');
            $table->string('comercialPhone');
            $table->string('residencialPhone');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('responsibles');
    }
}
