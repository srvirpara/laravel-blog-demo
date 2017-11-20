<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdatePostsAddSeo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function(Blueprint $table)
        {
            $table->string('meta_title', 191)->after('content')->nullable();
            $table->text('meta_description', 65535)->after('meta_title')->nullable();
            $table->text('meta_keywords', 65535)->after('meta_description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function(Blueprint $table) {
             $table->dropColumn('meta_title');
             $table->dropColumn('meta_description');
             $table->dropColumn('meta_keywords');
        });
    }
}
