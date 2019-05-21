<?php

/*
|--------------------------------------------------------------------------
| Back End
|--------------------------------------------------------------------------
|
| These are the routes that control everything in the dashboard
|
*/

//enter dashboard and login

Route::group(['prefix' => 'dashboard','middleware' => 'web'], function () {
  Route::get('/login', 'App\Http\Controllers\DashboardAuth\LoginController@showLoginForm')->name('login');
  Route::post('/login', 'App\Http\Controllers\DashboardAuth\LoginController@login');
  Route::post('/logout', 'App\Http\Controllers\DashboardAuth\LoginController@logout')->name('logout');

  Route::get('/register', 'App\Http\Controllers\DashboardAuth\RegisterController@showRegistrationForm')->name('register');
  Route::post('/register', 'App\Http\Controllers\DashboardAuth\RegisterController@register');

  Route::post('/password/email', 'App\Http\Controllers\DashboardAuth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
  Route::post('/password/reset', 'App\Http\Controllers\DashboardAuth\ResetPasswordController@reset')->name('password.email');
  Route::get('/password/reset', 'App\Http\Controllers\DashboardAuth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
  Route::get('/password/reset/{token}', 'App\Http\Controllers\DashboardAuth\ResetPasswordController@showResetForm');

Route::get('/','App\Http\Controllers\DashboardController@index');
Route::get('/home','App\Http\Controllers\DashboardController@index');



//view datatypes - IE pages type, posts type, etc
Route::get('/types','App\Http\Controllers\DashboardController@types')->name('types');
// create new datatype
Route::get('/type/create','App\Http\Controllers\DashboardController@typeCreate');
// store datatype
Route::post('/type/store','App\Http\Controllers\DashboardController@typeStore');
// edit datatype
Route::get('/type/{slug}/edit','App\Http\Controllers\DashboardController@typeEdit');
// delete datatype
Route::get('/type/{slug}/delete','App\Http\Controllers\DashboardController@typeDelete');
// custom type delete
Route::post('/customfield/{id}/delete','App\Http\Controllers\DashboardController@typeCustomDelete');



//view menus - IE top menu, footer, etc
Route::get('/menus','App\Http\Controllers\DashboardController@menus')->name('menus');
// Create New Menu
Route::get('/menu/create','App\Http\Controllers\DashboardController@menuCreate');
// Store Menu
Route::post('/menu/store','App\Http\Controllers\DashboardController@menuStore');
// View menu with all associated nav items for editing and reorder
Route::get('/menu/{slug}/details','App\Http\Controllers\DashboardController@menuDetails')->name('menu-details');
// Store Nav items and rearrange menu
Route::post('/menu/{slug}/update','App\Http\Controllers\DashboardController@menuUpdate');
// Edit Menu
Route::get('/menu/{slug}/edit','App\Http\Controllers\DashboardController@menuEdit');
// Delete Menu
Route::get('/menu/{slug}/delete','App\Http\Controllers\DashboardController@menuDelete');




//view components - IE users loop, blog preview box, events ad, additional info box, etc
Route::get('/components','App\Http\Controllers\DashboardController@components')->name('components');
// create new frequent component (from template component, this is for adding components that have the same inserted content easily to multiple pages)
Route::get('/component/create','App\Http\Controllers\DashboardController@componentCreate');
// store component
Route::post('/component/store','App\Http\Controllers\DashboardController@componentStore');
// edit single component
Route::get('/component/{slug}/edit','App\Http\Controllers\DashboardController@componentEdit');
// delete component
Route::get('/component/{slug}/delete','App\Http\Controllers\DashboardController@componentDelete');



//view categories - IE pages type, posts type, etc
Route::get('/categories','App\Http\Controllers\DashboardController@categories')->name('categories');
// create new category
Route::get('/category/create','App\Http\Controllers\DashboardController@categoryCreate');
// store category
Route::post('/category/store','App\Http\Controllers\DashboardController@categoryStore');
// edit single category
Route::get('/category/{slug}/edit','App\Http\Controllers\DashboardController@categoryEdit');
// delete category
Route::get('/category/{slug}/delete','App\Http\Controllers\DashboardController@categoryDelete');



//view media - IE images, video, docs, etc
Route::get('/media','App\Http\Controllers\DashboardController@media')->name('media');//view datatypes - IE pages type, posts type, etc
Route::get('/media/create','App\Http\Controllers\DashboardController@mediaCreate');
Route::post('/media/store','App\Http\Controllers\DashboardController@mediaStore');
Route::post('/media/delete','App\Http\Controllers\DashboardController@mediaDelete');

//view Members
/*
Route::get('/members','App\Http\Controllers\DashboardController@members')->name('members');//view members
Route::get('/member/create','App\Http\Controllers\DashboardController@memberCreate');
Route::post('/member/store','App\Http\Controllers\DashboardController@memberStore');
Route::get('/member/{slug}/edit','App\Http\Controllers\DashboardController@memberEdit');
Route::post('/member/active/update','App\Http\Controllers\DashboardController@memberUpdate');
Route::post('/member/delete','App\Http\Controllers\DashboardController@memberDelete');
*/


// View forms - IE images, video, docs, etc
Route::get('/forms','App\Http\Controllers\DashboardController@forms')->name('forms');//view datatypes - IE pages type, posts type, etc
// Create New Form
Route::get('/form/create','App\Http\Controllers\DashboardController@formCreate');
// Store Form
Route::post('/form/store','App\Http\Controllers\DashboardController@formStore');
// View Form with all associated question items for editing and reorder
Route::get('/form/{slug}/details','App\Http\Controllers\DashboardController@formDetails')->name('formDetails');
// Store Form items and rearrange Form
Route::post('/form/{slug}/update','App\Http\Controllers\DashboardController@formUpdate');
// Edit Form
Route::get('/form/{slug}/edit','App\Http\Controllers\DashboardController@formEdit');
// Delete Form
Route::get('/form/{slug}/delete','App\Http\Controllers\DashboardController@formDelete');
// View Submission
Route::get('/form/{slug}/submissions','App\Http\Controllers\DashboardController@formSubmissions')->name('submissions');
// Delete Submission
Route::get('/form/{slug}/massdelete','App\Http\Controllers\DashboardController@submissionMassDelete')->name('submissionsMassDelete');
// Export Form Submissions
Route::get('/export/form/{id}','App\Http\Controllers\DashboardController@export')->name('export');
// Delete Form Submissions
Route::post('/submission/delete','App\Http\Controllers\DashboardController@submissionDelete');



// View FAQ
Route::get('/service/faq','App\Http\Controllers\DashboardController@serviceFaq');
// Create Ticket
Route::get('/service/help','App\Http\Controllers\DashboardController@serviceHelp');
// submit ticket
Route::post('/service/submit','App\Http\Controllers\DashboardController@serviceSubmit');



//view content datatype - IE all pages, posts, etc
Route::get('/{type}/all','App\Http\Controllers\DashboardController@contents')->name('contents');
// create content
Route::get('/{type}/create','App\Http\Controllers\DashboardController@contentCreate');
// store content
Route::post('/{type}/store/{draft?}','App\Http\Controllers\DashboardController@contentStore');
Route::post('/{type}/store/{id}/{draft?}','App\Http\Controllers\DashboardController@contentStore');
// update content
Route::post('/{type}/active/update','App\Http\Controllers\DashboardController@contentUpdate');
// edit single datatype - IE page, post, etc
Route::get('/{type}/{id}/edit','App\Http\Controllers\DashboardController@contentEdit');
// delete content
Route::post('/{type}/delete','App\Http\Controllers\DashboardController@contentDelete');


// View Users
Route::get('/users','App\Http\Controllers\DashboardController@users')->name('users');
// Edit User
Route::get('/user/{user}/edit','App\Http\Controllers\DashboardController@userEdit');
// Save User
Route::post('/user/{user}/edit','App\Http\Controllers\DashboardController@userUpdate');
// Delete User
Route::get('/user/{user}/delete','App\Http\Controllers\DashboardController@userDelete');


Route::get('/{slug}','App\Http\Controllers\PageController@preview')->name('preview');


/* WINDFALL ADMIN ONLY ROUTES */
//View and quick edit templates
Route::get('/template/{slug}','App\Http\Controllers\DashboardController@pages');

});


/*
|--------------------------------------------------------------------------
| Front End
|--------------------------------------------------------------------------
|
| These are the routes that control everything in the front end display
|
|
*/

Route::group(['middleware' => 'web'], function () {
Route::get('/','App\Http\Controllers\PageController@home');
Route::get('/home','App\Http\Controllers\PageController@home');
Route::get('/blog','App\Http\Controllers\PageController@blog');

Route::get('/get/loop/{id}','App\Http\Controllers\PageController@loopContent');

// Save form data
Route::post('/form/{form}','App\Http\Controllers\PageController@form');

// Go to Page
Route::get('/{type}/{slug}','App\Http\Controllers\PageController@pageByType')->name('pageByType');
Route::post('/search','App\Http\Controllers\PageController@search');
Route::get('/{slug}','App\Http\Controllers\PageController@page')->name('page');

});
