<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogisticsTable extends Migration
{
    public function up()
    {
        Schema::create('logistics', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id');
            $table->string('availableDays');
            $table->string('availableHours');
            $table->enum('attendanceMode', ['face-to-face', 'phone', 'digital']);
            $table->enum('openingStatus', ['open', 'openingSoon', 'openingLater']);
            $table->timestamps();
            $table->softDeletes();

            // Adicionar chave estrangeira para empresa
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('logistics');
    }
}
