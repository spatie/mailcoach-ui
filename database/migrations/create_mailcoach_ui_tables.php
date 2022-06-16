<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->timestamp('welcome_valid_until')->nullable();
        });

        Schema::create('mailcoach_settings', function (Blueprint $table) {
            $table->string('key')->index();
            $table->text('value')->nullable();
        });

        Schema::create('mailcoach_mailers', function (Blueprint $table) {
            $table->id();
            $table->uuid()->index();
            $table->string('name');
            $table->string('transport');
            $table->longText('configuration')->nullable();
            $table->boolean('default')->default(false);
            $table->boolean('ready_for_use')->default(false);
            $table->timestamps();
        });
    }
};
