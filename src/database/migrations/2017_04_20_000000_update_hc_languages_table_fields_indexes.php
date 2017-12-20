<?php

declare(strict_types = 1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use interactivesolutions\honeycomblanguages\app\models\HCLanguages;
use interactivesolutions\honeycombpages\app\models\HCPagesCategoriesTranslations;

/**
 * Class UpdateHcLanguagesTableFieldsIndexes
 */
class UpdateHcLanguagesTableFieldsIndexes extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('hc_languages', function (Blueprint $table) {
            $table->index('iso_639_1');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('hc_languages', function (Blueprint $table) {
            $table->dropIndex('hc_languages_iso_639_1_index');
        });
    }

}
