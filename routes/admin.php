<?php
 use Illuminate\Support\Facades\Route;

//region Admin Routes
Route::group(['prefix' => 'admin','as' => 'admin.'],function(){

    //region User Routes
    Route::put('user/{user}/update_role',[\App\Http\Controllers\Admin\User\UserController::class,'update_role'])
        ->name('user.update_role');

    Route::put('user/{user}/update_permission',[\App\Http\Controllers\Admin\User\UserController::class,'update_permission'])

    ->name('user.update_permission');
    Route::resource('user',\App\Http\Controllers\Admin\User\UserController::class);
    //endregion

    Route::get('settings', [\App\Http\Controllers\Admin\Settings\SettingsController::class,'index'])
        ->name('settings.index');
    Route::post('settings', [\App\Http\Controllers\Admin\Settings\SettingsController::class,'update'])
        ->name('settings.update');
});
//endregion
