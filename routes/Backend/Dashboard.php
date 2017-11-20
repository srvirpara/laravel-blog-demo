<?php

/*
 * General Slug generator
 */
Route::any('generateSlug', function (\Illuminate\Http\Request $request) {
    return str_slug($request['text']);
})->name('admin.generate.slug');


Route::group(['middleware' => 'auth'], function () {

	 /*
     * Users Management
     */
 	 Route::any('users', 'UsersController@getIndex');
     Route::any('users/get', 'UsersController@anyData')->name('admin.users.get');

     /*
     * Blogs Management
     */
     Route::any('/', 'BlogController@getIndex')->name('admin.blog.index');
     Route::any('/admin', 'BlogController@getIndex')->name('admin.blog.index');
     Route::any('blog', 'BlogController@getIndex')->name('admin.blog.index');
     Route::any('blog/get', 'BlogController@getData')->name('admin.blog.get');
     Route::get('create-blog', 'BlogController@create')->name('admin.blog.create');
     Route::post('store-blog', 'BlogController@store')->name('admin.blog.store');
     Route::get('edit-blog/{id}', 'BlogController@edit')->name('admin.blog.edit');
     Route::any('update-blog', 'BlogController@update')->name('admin.blog.update');
	 Route::get('delete-blog/{id}', 'BlogController@destroy')->name('admin.blog.delete');

     /*
     * Blogs category Management
     */
     Route::any('blog-category', 'BlogCategoriesController@index')->name('admin.blogcategories.index');
     Route::any('blog-category/get', 'BlogCategoriesController@getData')->name('admin.blogcategories.get');
     Route::get('create-blog-category', 'BlogCategoriesController@create')->name('admin.blogcategories.create');
     Route::post('store-blog-category', 'BlogCategoriesController@store')->name('admin.blogcategories.store');
     Route::get('edit-blog-category/{id}', 'BlogCategoriesController@edit')->name('admin.blogcategories.edit');
     Route::any('update-blog-category', 'BlogCategoriesController@update')->name('admin.blogcategories.update');
     Route::get('delete-blog-category/{id}', 'BlogCategoriesController@destroy')->name('admin.blogcategories.delete');


     /*
     * Blogs tags Management
     */
     Route::any('blog-tag', 'BlogTagsController@index')->name('admin.blogtag.index');
     Route::any('blog-tag/get', 'BlogTagsController@getData')->name('admin.blogtag.get');
     Route::get('create-blog-tag', 'BlogTagsController@create')->name('admin.blogtag.create');
     Route::post('store-blog-tag', 'BlogTagsController@store')->name('admin.blogtag.store');
     Route::get('edit-blog-tag/{id}', 'BlogTagsController@edit')->name('admin.blogtag.edit');
     Route::any('update-blog-tag', 'BlogTagsController@update')->name('admin.blogtag.update');
     Route::get('delete-blog-tag/{id}', 'BlogTagsController@destroy')->name('admin.blogtag.delete');
});

    
