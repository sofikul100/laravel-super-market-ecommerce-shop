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
        Schema::create('parent_categories', function (Blueprint $table) {
            $table->id();
            $table->string('parent_categorie_name');
            $table->string('parent_categorie_slug');
            $table->string('parent_categorie_imgage');
            $table->text('parent_categorie_description')->nullable();
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
        Schema::dropIfExists('parent_categories');
    }
};
