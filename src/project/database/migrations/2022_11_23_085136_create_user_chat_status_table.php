<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_chat_status', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_online')->default(false);
            $table->boolean('is_calling')->default(false);
            $table->string('peer_id')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('active_user_id')->nullable();
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
        Schema::dropIfExists('user_chat_status');
    }
};
