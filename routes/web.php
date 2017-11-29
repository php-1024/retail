<?php


/*程序管理系统*/
Route::get('ppp', function () {
    return view('welcome');
});
Route::group(['prefix'=>'pro'],function(){

});


