<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartnerDocumentsTable extends Migration
{
    public function up()
    {
        Schema::create('partners_documents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('partner_id');
            $table->string('identification');
            $table->string('addressProof');
            $table->string('storeFront');
            $table->string('storeInterior');
            $table->timestamps();
            $table->foreign('partner_id')->references('id')->on('partners')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('partners_documents');
    }
}
