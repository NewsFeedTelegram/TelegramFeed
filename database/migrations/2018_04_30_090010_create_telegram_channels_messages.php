<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTelegramChannelsMessages extends Migration
{
    public function up()
    {
        Schema::create('telegram_channels_messages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tg_channel_id')->unsigned();
            $table->json('fwd_from')->nullable();
            $table->integer('message_id')->unsigned();
            $table->timestamp('date');
            $table->text('message');
            $table->json('media');
            $table->timestamps();

            $table->foreign('tg_channel_id')
                ->references('id')
                ->on('telegram_channels')
                ->onUpdate('cascade')
                ->onDelete('cascade');
//            $table->foreign('fwd_from')
//                ->references('id')
//                ->on('telegram_channels')
//                ->onUpdate('cascade')
//                ->onDelete('cascade');
        });
    }

    public function down()
    {
        //
    }
}
