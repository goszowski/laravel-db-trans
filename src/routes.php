<?php

Route::group(['prefix'=>'laravel-db-trans', 'as'=>'laravel-db-trans.', 'namespace' => 'Goszowski\LaravelDbTrans', 'middleware' => ['web']], function(){
  Route::get('/', ['as'=>'index', 'uses'=>'LaravelDbTransController@index']);
  Route::get('/{key}', ['as'=>'edit', 'uses'=>'LaravelDbTransController@edit']);
  Route::patch('/{key}', ['as'=>'update', 'uses'=>'LaravelDbTransController@update']);
  Route::delete('/{key}', ['as'=>'destroy', 'uses'=>'LaravelDbTransController@destroy']);
});
