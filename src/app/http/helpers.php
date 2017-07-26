<?php

use interactivesolutions\honeycomblanguages\app\models\HCLanguages;

if( ! function_exists('getHCFrontEndLanguages') ) {

    /**
     * Getting available frontEnd languages
     *
     * @param bool $asArray
     * @return mixed
     */
    function getHCFrontEndLanguages(bool $asArray = true)
    {
        return getHCLanguages('front_end', $asArray);
    }
}

if( ! function_exists('getHCBackEndLanguages') ) {

    /**
     * Getting available backend languages
     *
     * @param bool $asArray
     * @return mixed
     */
    function getHCBackEndLanguages(bool $asArray = true)
    {
        return getHCLanguages('back_end', $asArray);
    }
}

if( ! function_exists('getHCContentLanguages') ) {

    /**
     * Getting available content languages
     *
     * @param bool $asArray
     * @return mixed
     */
    function getHCContentLanguages(bool $asArray = true)
    {
        $available = getHCLanguages('content', $asArray);

        $current = session('content', app()->getLocale());

        if( ! $current || ! in_array($current, $available) ) {
            return $available;
        }

        $reordered = array_diff($available, [$current]);

        array_unshift($reordered, $current);

        return $reordered;
    }
}

if( ! function_exists('getHCLanguages') ) {
    /**
     * Retrieving languages
     *
     * @param string $key - front_end, back_end, content
     * @param bool $asArray
     * @return mixed
     */
    function getHCLanguages(string $key, bool $asArray = true)
    {
        $list = HCLanguages::where($key, 1)->get();

        if( $asArray )
            return $list->pluck('iso_639_1')->toArray();

        return $list;
    }
}

if( ! function_exists('getHCLanguagesOptions') ) {
    /**
     * Retrieving languages
     *
     * @param null|string $type
     * @param array $columns
     * @return \Illuminate\Support\Collection
     * @throws Exception
     */
    function getHCLanguagesOptions(string $type = null, array $columns = [])
    {
        $columns[] = 'iso_639_1 as id';

        if( ! $type ) {
            return HCLanguages::select($columns)->get();
        }

        $types = ['front_end', 'back_end', 'content'];

        if( ! in_array($type, $types) ) {
            throw new \Exception('Incorrect given type');
        }

        return HCLanguages::where($type, '1')->select($columns)->get();
    }
}