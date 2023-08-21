<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_type_id')->nullable();
            $table->tinyInteger('has_no_debt')->nullable();
            $table->string('cnpj', 15)->nullable();
            $table->string('name', 150)->nullable();
            $table->string('debt', 10)->nullable();
            $table->unsignedSmallInteger('sector')->nullable();
            $table->char('agent_id', 11)->nullable();
            $table->unsignedInteger('type_consumer')->nullable();
            $table->unsignedInteger('activated')->nullable();
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
            $table->dateTime('created_at_app')->nullable();
            $table->unsignedInteger('id_rede')->nullable();
            $table->unsignedInteger('type')->nullable();
            $table->unsignedInteger('category')->nullable();
            $table->string('pdv_code', 25)->nullable();
            $table->string('sector', 45)->nullable();
            $table->string('latitude', 20)->nullable();
            $table->string('longitude', 20)->nullable();
            $table->string('responsible_cellphone', 15)->nullable();
            $table->tinyInteger('remember')->default(0);
            $table->text('notification_preferences')->nullable();
            $table->unsignedInteger('type_consumer')->nullable();
            $table->string('regiao', 50)->nullable();
            $table->date('responsible_birthday')->nullable();
            $table->string('key', 255)->nullable();
            $table->string('dia_semana', 50)->nullable();
            $table->unsignedInteger('de')->nullable();
            $table->unsignedInteger('ate')->nullable();
            $table->string('turno', 50)->nullable();
            $table->dateTime('last_login_at')->nullable();
            $table->string('atendimento', 20)->nullable();
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
        Schema::dropIfExists('clients');
    }
};
