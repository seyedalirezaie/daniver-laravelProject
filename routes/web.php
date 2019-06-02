<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/


/**admin**/

Route::group(['middleware' => 'verified'] , function () {
    Route::get('/administrator', 'Admin\MainController@index');
    Route::get('/administrator/blog/create', 'Admin\PostController@create')->name('blog.post.create');/*->middleware('role:master-admin');*/
    Route::post('/api/administrator/blog/store', 'Admin\PostController@store');
    Route::post('api/administrator/post/upload', 'Admin\PhotoController@apiPostImage');

    Route::resource('/administrator/roles', 'Admin\RoleController');
    Route::resource('/administrator/permissions', 'Admin\PermissionController');
    Route::get('/administrator/users', 'Admin\UserController@index');
    Route::get('/api/administrator/users/{query?}/{items?}', 'Admin\UserController@users');
    Route::get('/administrator/user/{userId}/permissions', 'Admin\UserController@permissions');
    Route::post('/administrator/store/user/{userId}', 'Admin\UserController@storePermissions')->name('user.store');
});
/**end admin**/


/**home**/
Route::get('/' , 'FrontEnd\HomeController@index');
Route::get('/api/blog/posts/{searchQuery?}' , 'FrontEnd\PostController@apiBlogPosts');

/**study**/
Route::get('study' , 'FrontEnd\StudyController@index')->name('study');
Route::get('study/college/{slug}' , 'FrontEnd\StudyController@college')->name('study.college');
Route::get('study/posts/{categoryId}/{postSlug?}' , 'FrontEnd\StudyController@posts')->name('study.posts');
Route::post('study/photoUpload' , 'FrontEnd\PhotoController@postPhotoUpload');
/*api*/
Route::get('api/tags' , 'FrontEnd\TagController@apiTags');
/*api*/

/*api*/
Route::get('api/posts/{slug}/{query?}/{searchType?}/{timeFilter}/{otherFilters}/{orderFilter}/{searchTag}/{items?}' , 'FrontEnd\PostController@apiPosts');
Route::get('api/post/{postId}' , 'FrontEnd\PostController@apiSelectPost');
Route::get('api/postBySlug/{postSlug}/{postItems}' , 'FrontEnd\PostController@apiSelectPostBySlug');
/*api*/
Route::post('api/upload/post' , 'FrontEnd\PhotoController@apiPostImage');

/**register**/
/*api*/
Route::get('api/register/initial' , 'Auth\RegisterController@initialize');
Route::get('api/register/getCities/{provinceId}' , 'Auth\RegisterController@getCities');
Route::get('api/register/getSubCities/{cityId}' , 'Auth\RegisterController@getSubCities');
Route::post('register' , 'Auth\RegisterController@create');
Route::post('api/upload' , 'FrontEnd\PhotoController@apiProfileImage');


/**users**/
Route::get('users' , 'FrontEnd\UserController@index');
/*profile*/
Route::get('profile/{alias}' , 'FrontEnd\ProfileController@profile');
Route::get('api/getUsers/{searchQuery?}' , 'FrontEnd\ProfileController@getUsers');
Route::post('api/profile/checkFriendShip' , 'FrontEnd\FriendController@checkFriendShip');
/*friend*/
Route::get('api/getFriends/{userId}/{searchQuery?}' , 'FrontEnd\FriendController@getFriends');
Route::post('api/friends/friendRequest' , 'FrontEnd\FriendController@friendRequest');
Route::post('api/profile/acceptFriendShip' , 'FrontEnd\FriendController@acceptFriendShip');

/**panel**/
Route::get('panel/{userId}' , 'FrontEnd\PanelController@index');
Route::post('api/friends/cancelFriendShip' , 'FrontEnd\FriendController@cancelFriendShip');


/*api check auth*/
Route::post('api/checkAuth' , 'FrontEnd\UserController@apiCheckAuth');
/*api check category*/
Route::get('api/checkCategory/{categoryId}' , 'FrontEnd\UserController@apiCheckCategory');


Route::group(['middleware' => 'auth' , 'verified'] , function (){
    Route::post('api/doLike' , 'FrontEnd\LikeController@apiDoLike');
    Route::post('api/hasLike' , 'FrontEnd\LikeController@apihasLike');
    /*last seen*/
    Route::post('api/lastSeen' , 'FrontEnd\UserController@apiSetLastSeen');
    /*post comment*/
    Route::post('api/postComment' , 'FrontEnd\CommentController@apiPostComment');

    Route::get('api/notifications/init' , 'FrontEnd\UserController@initNotifications');
    /*post store*/
    Route::post('api/storePost' , 'FrontEnd\PostController@apiPostStore');
});









Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');
