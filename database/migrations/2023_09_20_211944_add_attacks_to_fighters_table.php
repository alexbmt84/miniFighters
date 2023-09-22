<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAttacksToFightersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fighters', function (Blueprint $table) {
            $table->string('attack_name_1');
            $table->string('attack_name_2');
            $table->integer('attack_damages_1');
            $table->integer('attack_damages_2');
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
