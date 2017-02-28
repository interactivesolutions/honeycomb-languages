<?php

//./packages//interactivesolutions/honeycomb-languages/src/app/routes/routes.languages.php

Route::group(['prefix' => 'admin', 'middleware' => ['web', 'auth']], function ()
{
    Route::get('languages', ['as' => 'admin.languages', 'middleware' => ['acl:interactivesolutions_honeycomb_languages_languages_list'], 'uses' => 'HCLanguagesController@adminView']);

    Route::group(['prefix' => 'api'], function ()
    {
        Route::get('languages', ['as' => 'admin.api.languages', 'middleware' => ['acl:interactivesolutions_honeycomb_languages_languages_list'], 'uses' => 'HCLanguagesController@listData']);
        Route::get('languages/search', ['as' => 'admin.api.languages.search', 'middleware' => ['acl:interactivesolutions_honeycomb_languages_languages_list'], 'uses' => 'HCLanguagesController@search']);
        Route::put('languages/{id}/strict', ['as' => 'admin.api.languages.update.strict', 'middleware' => ['acl:interactivesolutions_honeycomb_languages_languages_update'], 'uses' => 'HCLanguagesController@updateStrict']);
    });
});

