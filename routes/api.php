<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

    // App Settings
    Route::apiResource('app-settings', 'AppSettingsApiController');

    // Real Estate Types
    Route::apiResource('real-estate-types', 'RealEstateTypesApiController');

    // Real Estates
    Route::post('real-estates/media', 'RealEstateApiController@storeMedia')->name('real-estates.storeMedia');
    Route::apiResource('real-estates', 'RealEstateApiController');

    // Services
    Route::post('services/media', 'ServicesApiController@storeMedia')->name('services.storeMedia');
    Route::apiResource('services', 'ServicesApiController');
});
