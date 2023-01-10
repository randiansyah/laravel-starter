<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task', function (Blueprint $table) {
            $table->id();
            $table->char('name', 100);
            $table->longText('description');
            $table->integer('category');
            $table->integer('deadline');
            $table->string('image');
            $table->string('path_image');
            $table->string('image1');
            $table->string('path_image1');
            $table->integer('price');
            $table->integer('limit');
            $table->char('notes', 200);
            $table->enum('status', ['active', 'inactive']);
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
        Schema::dropIfExists('task');
    }
}
