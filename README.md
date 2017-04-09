[![Total Downloads](https://poser.pugx.org/goszowski/laravel-db-trans/d/total.svg)](https://packagist.org/packages/goszowski/laravel-db-trans)
[![Latest Stable Version](https://poser.pugx.org/goszowski/laravel-db-trans/v/stable.svg)](https://packagist.org/packages/goszowski/laravel-db-trans)
[![Latest Unstable Version](https://poser.pugx.org/goszowski/laravel-db-trans/v/unstable.svg)](https://packagist.org/packages/goszowski/laravel-db-trans)
[![License](https://poser.pugx.org/goszowski/laravel-db-trans/license.svg)](https://packagist.org/packages/goszowski/laravel-db-trans)

## LaravelDbTrans

LaravelDbTrans is a package for automatic creating and edition translates in database.

##### Template:
```html
{{ __('Some words') }}
```

##### or using prefix:
```html
{{ __('myprefix.Some words') }}
```

##### In both cases, records will be created in the database, and returned to the tempate only "Some words"

## Installation

1. Require this package in your composer.json and run composer update :

		"goszowski/laravel-db-trans": "1.*"

 2. After composer update, add service providers to the `config/app.php`

	    Goszowski\LaravelDbTrans\LaravelDbTransServiceProvider::class,
      
 3. Run
 
	    php artisan vendor:publish
      
 3. Migrate
 
	    php artisan migrate
      
 ## Configuration
 Visit url `/laravel-db-trans` in your app. Here will be all translations that will be created. 
 
 If You want to protect this url or change name, You must disable option `use_package_routes` in `config/laraveldbtrans.php`
 
 After this, You must create routes for you app by this template:
```php
Route::group(['prefix'=>'laravel-db-trans', 'as'=>'laravel-db-trans.'], function(){
  Route::get('/', ['as'=>'index', 'uses'=>'\Goszowski\LaravelDbTrans\LaravelDbTransController@index']);
  Route::get('/{key}', ['as'=>'edit', 'uses'=>'\Goszowski\LaravelDbTrans\LaravelDbTransController@edit']);
  Route::patch('/{key}', ['as'=>'update', 'uses'=>'\Goszowski\LaravelDbTrans\LaravelDbTransController@update']);
  Route::delete('/{key}', ['as'=>'destroy', 'uses'=>'\Goszowski\LaravelDbTrans\LaravelDbTransController@destroy']);
});
```

Also, You can customize blade templates in `views/vendor/laravel-db-trans`
