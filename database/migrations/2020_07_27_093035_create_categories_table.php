<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {//create tables according to real life exp like when u visit any shop man >> cate which cloth >> which t-shirt etc 
        Schema::create('categories', function (Blueprint $table) {
            $table->id();//cate id like t-shirt
            $table->integer('parent_id');//parent_id all t-shirts
            $table->integer('section_id');//particular section t-shirts id 
            $table->string('category_name');
            $table->string('category_image');
            $table->float('category_discount');
            $table->text('description');
            $table->string('url');
            $table->string('meta_title');
            $table->string('meta_description');
            $table->string('meta_keywords');
            $table->tinyInteger('status');
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
        Schema::dropIfExists('categories');
    }
}
//https://www.youtube.com/watch?v=2y0MmiETD98&list=PLLUtELdNs2ZaHaFmydqjcQ-YyeQ19Cd6u&index=19
