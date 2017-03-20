<?php

use interactivesolutions\honeycomblanguages\app\models\HCLanguages;

if (!function_exists ('getHCFrontEndLanguages')) {

    /**
     * Getting available frontEnd languages
     *
     * @return mixed
     */
    function getHCFrontEndLanguages()
    {
        return HCLanguages::where('front_end', 1)->select('id', 'iso_639_1', 'language')->get();
    }
}

if (!function_exists ('getHCBackEndLanguages')) {

    /**
     * Getting available backend languages
     *
     * @return mixed
     */
    function getHCBackEndLanguages()
    {
        return HCLanguages::where('back_end', 1)->select('id', 'iso_639_1', 'language')->get();
    }
}

if (!function_exists ('getHCContentLanguages')) {

    /**
     * Getting available content languages
     *
     * @return mixed
     */
    function getHCContentLanguages()
    {
        return HCLanguages::where('content', 1)->select('id', 'iso_639_1', 'language')->get();
    }
}