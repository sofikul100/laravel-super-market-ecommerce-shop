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
        Schema::create('child_categories', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('parent_categorie_id');
            $table->bigInteger('sub_categorie_id');
            $table->string('child_categorie_name');
            $table->string('child_categorie_slug');
            $table->text('child_categorie_description')->nullable();
            $table->string('child_categorie_image');
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
        Schema::dropIfExists('child_categories');
    }
};
