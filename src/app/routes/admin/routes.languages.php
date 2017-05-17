<?php

Route::group(['prefix' => env('HC_ADMIN_URL'), 'middleware' => ['web', 'auth']], function ()
{
    Route::get('languages', ['as' => 'admin.languages', 'middleware' => ['acl:interactivesolutions_honeycomb_languages_languages_list'], 'uses' => 'HCLanguagesController@adminIndex']);

    Route::group(['prefix' => 'api/languages'], function ()
    {
        Route::get('/', ['as' => 'admin.api.languages', 'middleware' => ['acl:interactivesolutions_honeycomb_languages_languages_list'], 'uses' => 'HCLanguagesController@apiIndexPaginate']);

        Route::put('{id}/strict', ['as' => 'admin.api.languages.update.strict', 'middleware' => ['acl:interactivesolutions_honeycomb_languages_languages_update'], 'uses' => 'HCLanguagesController@apiUpdateStrict']);
    });
});
