<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFightersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up() {

        Schema::create('fighters', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('avatar_path');
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
        Schema::dropIfExists('fighters');
    }
}
