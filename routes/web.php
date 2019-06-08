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
Route::group(['middleware' =>  ['verified' , 'permission:enter-admin-panel']] , function () {
    Route::group(['prefix' => 'administrator'] , function () {
        Route::get('/', 'Admin\MainController@index')->name('admin.home');
        Route::get('/blog/create', 'Admin\PostController@create')->name('blog.post.create');/*->middleware('role:master-admin');*/
        Route::resource('/roles', 'Admin\RoleController');
        Route::resource('/permissions', 'Admin\PermissionController');
        Route::get('/users', 'Admin\UserController@index');
        Route::get('/user/{userId}/permissions', 'Admin\UserController@permissions');
        Route::post('/store/user/{userId}', 'Admin\UserController@storePermissions')->name('user.store');
        Route::get('/categories/blog', 'Admin\CategoryController@blogCategories')->name('categories.blog');
        Route::get('/api/categories/{type}', 'Admin\CategoryController@getCategories');
        Route::post('/api/categories/delete', 'Admin\CategoryController@deleteCategories');
    });
        Route::post('/api/administrator/blog/store', 'Admin\PostController@store');
        Route::post('api/administrator/post/upload', 'Admin\PhotoController@apiPostImage');
        Route::get('/api/administrator/users/{query?}/{items?}', 'Admin\UserController@users');

});
/**end admin**/


/**home**/
Route::get('/' , 'FrontEnd\HomeController@index');
Route::get('/api/blog/posts/{searchQuery?}' , 'FrontEnd\BlogPostController@apiBlogPosts');
/**study**/
Route::get('study' , 'FrontEnd\StudyController@index')->name('study');
Route::get('study/college/{slug}' , 'FrontEnd\StudyController@college')->name('study.college');
Route::get('study/posts/{categoryId}/{postSlug?}' , 'FrontEnd\StudyController@posts')->name('study.posts');
Route::post('study/photoUpload' , 'FrontEnd\PhotoController@postPhotoUpload');
Route::get('api/tags' , 'FrontEnd\TagController@apiTags');
Route::get('api/posts/{slug}/{query?}/{searchType?}/{timeFilter}/{otherFilters}/{orderFilter}/{searchTag?}/{items?}' , 'FrontEnd\PostController@apiPosts');
Route::get('api/post/{postId}' , 'FrontEnd\PostController@apiSelectPost');
Route::get('api/postBySlug/{postSlug}/{postItems}' , 'FrontEnd\PostController@apiSelectPostBySlug');
Route::post('api/upload/post' , 'FrontEnd\PhotoController@apiPostImage');

/**register**/
Route::get('api/register/initial' , 'Auth\RegisterController@initialize');
Route::get('api/register/getCities/{provinceId}' , 'Auth\RegisterController@getCities');
Route::get('api/register/getSubCities/{cityId}' , 'Auth\RegisterController@getSubCities');
Route::post('register' , 'Auth\RegisterController@create');
Route::post('api/upload' , 'FrontEnd\PhotoController@apiProfileImage');

/**users**/
Route::get('users' , 'FrontEnd\UserController@index');
/*profile*/
Route::get('profile/{alias}' , 'FrontEnd\ProfileController@profile');
Route::get('api/getUsers/{searchQuery?}' , 'FrontEnd\UserController@getUsers');
Route::post('api/profile/checkFriendShip' , 'FrontEnd\FriendController@checkFriendShip');
/*friend*/
Route::get('api/getFriends/{userId}/{searchQuery?}' , 'FrontEnd\FriendController@getFriends');
Route::post('api/friends/friendRequest' , 'FrontEnd\FriendController@friendRequest');
Route::post('api/profile/acceptFriendShip' , 'FrontEnd\FriendController@acceptFriendShip');

/*blog*/
Route::get('blog/posts/{categorySlug}/{postSlug}' , 'FrontEnd\BlogPostController@post');


/*check auth*/
Route::post('api/checkAuth' , 'FrontEnd\UserController@apiCheckAuth');
/*check category*/
Route::get('api/checkCategory/{categoryId}' , 'FrontEnd\UserController@apiCheckCategory');
Route::post('api/hasLike' , 'FrontEnd\LikeController@apihasLike');


Route::group(['middleware' => ['auth']] , function (){
    /*panel*/
    Route::get('panel' , 'FrontEnd\PanelController@index');
    Route::get('api/notifications/init' , 'FrontEnd\PanelController@initNotifications');

});


Route::group(['middleware' => ['auth' , 'verified']] , function (){
    Route::post('api/doLike' , 'FrontEnd\LikeController@apiDoLike');
    /*last seen*/
    Route::post('api/lastSeen' , 'FrontEnd\UserController@apiSetLastSeen');
    /*post comment*/
    Route::post('api/postComment' , 'FrontEnd\CommentController@apiPostComment');
    /*post store*/
    Route::post('api/storePost' , 'FrontEnd\PostController@apiPostStore');



    /**panel**/

    Route::post('api/friends/cancelFriendShip' , 'FrontEnd\FriendController@cancelFriendShip');
    Route::post('/api/notifications/read' , 'FrontEnd\PanelController@readNotifications');
    Route::post('/api/status/change' , 'FrontEnd\PanelController@changeStatusNow');
});









Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');
