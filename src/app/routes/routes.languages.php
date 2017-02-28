<?php

Route::group(['prefix' => 'admin', 'middleware' => ['web', 'auth']], function ()
{
    Route::get('languages', ['as' => 'admin.languages', 'middleware' => ['acl:interactivesolutions_honeycomb_languages_languages_list'], 'uses' => 'HCLanguagesController@adminView']);

    Route::group(['prefix' => 'api'], function ()
    {
        Route::get('languages', ['as' => 'admin.api.languages', 'middleware' => ['acl:interactivesolutions_honeycomb_languages_languages_list'], 'uses' => 'HCLanguagesController@listData']);
        Route::get('languages/search', ['as' => 'admin.api.languages.search', 'middleware' => ['acl:interactivesolutions_honeycomb_languages_languages_list'], 'uses' => 'HCLanguagesController@search']);
        Route::get('languages/{id}', ['as' => 'admin.api.languages.single', 'middleware' => ['acl:interactivesolutions_honeycomb_languages_languages_list'], 'uses' => 'HCLanguagesController@getSingleRecord']);
        Route::post('languages/{id}/duplicate', ['as' => 'admin.api.languages.duplicate', 'middleware' => ['acl:interactivesolutions_honeycomb_languages_languages_update'], 'uses' => 'HCLanguagesController@duplicate']);
        Route::post('languages/restore', ['as' => 'admin.api.languages.restore', 'middleware' => ['acl:interactivesolutions_honeycomb_languages_languages_update'], 'uses' => 'HCLanguagesController@restore']);
        Route::post('languages/merge', ['as' => 'admin.api.languages.merge', 'middleware' => ['acl:interactivesolutions_honeycomb_languages_languages_update'], 'uses' => 'HCLanguagesController@merge']);
        Route::post('languages', ['middleware' => ['acl:interactivesolutions_honeycomb_languages_languages_create'], 'uses' => 'HCLanguagesController@create']);
        Route::put('languages/{id}', ['middleware' => ['acl:interactivesolutions_honeycomb_languages_languages_update'], 'uses' => 'HCLanguagesController@update']);
        Route::put('languages/{id}/strict', ['as' => 'admin.api.languages.update.strict', 'middleware' => ['acl:interactivesolutions_honeycomb_languages_languages_update'], 'uses' => 'HCLanguagesController@updateStrict']);
        Route::delete('languages/{id}', ['middleware' => ['acl:interactivesolutions_honeycomb_languages_languages_delete'], 'uses' => 'HCLanguagesController@delete']);
        Route::delete('languages', ['middleware' => ['acl:interactivesolutions_honeycomb_languages_languages_delete'], 'uses' => 'HCLanguagesController@delete']);
        Route::delete('languages/{id}/force', ['as' => 'admin.api.languages.force', 'middleware' => ['acl:interactivesolutions_honeycomb_languages_languages_force_delete'], 'uses' => 'HCLanguagesController@forceDelete']);
        Route::delete('languages/force', ['as' => 'admin.api.languages.force.multi', 'middleware' => ['acl:interactivesolutions_honeycomb_languages_languages_force_delete'], 'uses' => 'HCLanguagesController@forceDelete']);
    });
});
