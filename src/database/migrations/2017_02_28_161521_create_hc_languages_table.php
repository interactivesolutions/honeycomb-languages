<?php

declare(strict_types = 1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateHcLanguagesTable
 */
class CreateHcLanguagesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('hc_languages', function (Blueprint $table) {
            $table->integer('count', true);
            $table->string('id', 36)->unique();
            $table->string('language_family');
            $table->string('language');
            $table->string('native_name');
            $table->string('iso_639_1');
            $table->string('iso_639_2');
            $table->boolean('front_end')->default(0);
            $table->boolean('back_end')->default(0);
            $table->boolean('content')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::drop('hc_languages');
    }

}
