<?php

Route::group(['prefix' => 'api', 'middleware' => ['auth-apps']], function ()
{
    Route::get('languages', ['as' => 'api.languages', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_languages_languages_list'], 'uses' => 'HCLanguagesController@adminIndex']);

    Route::group(['prefix' => 'v1/languages'], function ()
    {
        Route::get('/', ['as' => 'api.v1.languages', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_languages_languages_list'], 'uses' => 'HCLanguagesController@apiIndexPaginate']);

        Route::group(['prefix' => 'list'], function ()
        {
            Route::get('/', ['as' => 'api.v1.languages.list', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_languages_languages_list'], 'uses' => 'HCLanguagesController@apiIndex']);
            Route::get('{timestamp}', ['as' => 'api.v1.languages.list.update', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_languages_languages_list'], 'uses' => 'HCLanguagesController@apiIndexSync']);
        });

        Route::put('{id}/strict', ['as' => 'api.v1.languages.update.strict', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_languages_languages_update'], 'uses' => 'HCLanguagesController@apiUpdateStrict']);
    });
});
