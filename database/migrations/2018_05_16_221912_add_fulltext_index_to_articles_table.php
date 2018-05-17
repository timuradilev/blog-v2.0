<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFulltextIndexToArticlesTable extends Migration
{
    /**
     * Run the migrations. Add fulltext index on content column in articles table
     *
     * @return void
     */
    public function up()
    {
        DB::statement("create fulltext index articles_content_fulltext on articles (content);");
    }

    /**
     * Reverse the migrations. Drop the articles_content_fulltext index.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropIndex('articles_content_fulltext');
        });
    }
}
