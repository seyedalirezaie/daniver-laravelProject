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
Route::post('/api/contactus' , 'FrontEnd\SupportController@contactUs');
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

/*dormitory*/
Route::get('dormitory' , 'FrontEnd\DormitoryController@index')->name('dormitory');
Route::get('dormitory/posts/{categoryId}/{postSlug?}' , 'FrontEnd\DormitoryController@posts')->name('dormitory.posts');

/*classmates*/
Route::get('classmates' , 'FrontEnd\ClassmateController@index')->name('classmates');
Route::get('classmates/college/{slug}' , 'FrontEnd\ClassmateController@college')->name('classmates.college');
Route::get('classmates/posts/{categoryId}/{postSlug?}' , 'FrontEnd\ClassmateController@posts')->name('classmates.posts');

/**register**/
Route::post('register' , 'Auth\RegisterController@create');
Route::post('api/upload' , 'FrontEnd\PhotoController@apiProfileImage');

/**users**/
Route::get('users' , 'FrontEnd\UserController@index');
/*profile*/
Route::get('profile/{alias}/{vueSection?}' , 'FrontEnd\ProfileController@profile');
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

Route::get('api/panel/initial' , 'FrontEnd\PanelController@initialize');
Route::get('api/panel/getCities/{provinceId}' , 'FrontEnd\PanelController@getCities');
Route::get('api/panel/getSubCities/{cityId}' , 'FrontEnd\PanelController@getSubCities');

Route::group(['middleware' => ['auth']] , function (){
    /*panel*/
    Route::get('panel/{vueSection?}' , 'FrontEnd\PanelController@index');

    Route::post('panel/edit/personal' , 'FrontEnd\PanelController@editPersonalInformation');
    Route::post('panel/edit/education' , 'FrontEnd\PanelController@editEducationInformation');
    Route::post('panel/edit/hobbies' , 'FrontEnd\PanelController@editHobbiesInformation');
    Route::post('panel/edit/accounts' , 'FrontEnd\PanelController@editAccountsInformation');
    Route::post('panel/delete/city' , 'FrontEnd\PanelController@deleteCity');
    Route::post('panel/edit/password' , 'FrontEnd\PasswordController@edit');
    Route::post('panel/messages/seen' , 'FrontEnd\HeaderPanelController@readAudienceMessages');
    Route::post('panel/messages/send' , 'FrontEnd\MessageController@sendMessage');
    Route::get('panel/friends/requests' , 'FrontEnd\PanelAlertsController@friendRequests');
    Route::get('api/notifications/init' , 'FrontEnd\HeaderPanelController@initNotifications');
    Route::post('panel/bookmarks/delete' , 'FrontEnd\BookmarkController@deleteBookmark');
    Route::post('api/panel/notifications/alerts' , 'FrontEnd\PanelAlertsController@initialize');
    Route::get('api/panel/notifications/messages' , 'FrontEnd\PanelAlertsController@messages');
    Route::post('api/panel/message' , 'FrontEnd\PanelAlertsController@getChat');
    Route::post('api/upload/header' , 'FrontEnd\GalleryController@apiHeaderImage');
    Route::post('api/userHeader/delete' , 'FrontEnd\GalleryController@apiDeleteHeaderImage');
    Route::post('api/userProfile/delete' , 'FrontEnd\PhotoController@apiDeleteProfileImage');
    /*panel > change password*/
});


Route::group(['middleware' => ['auth' , 'verified']] , function (){
    Route::post('api/doLike' , 'FrontEnd\LikeController@apiDoLike');
    /*last seen*/
    Route::post('api/lastSeen' , 'FrontEnd\UserController@apiSetLastSeen');
    /*post comment*/
    Route::post('api/postComment' , 'FrontEnd\CommentController@apiPostComment');
    /*post store*/
    Route::post('api/storePost' , 'FrontEnd\PostController@apiPostStore');
    /*post bookmark*/
    Route::post('api/doBookmark' , 'FrontEnd\BookmarkController@apiBookmarkPost');

    /**panel**/
    Route::post('api/friends/cancelFriendShip' , 'FrontEnd\FriendController@cancelFriendShip');
    Route::post('/api/notifications/read' , 'FrontEnd\HeaderPanelController@readNotifications');
    Route::post('/api/status/change' , 'FrontEnd\HeaderPanelController@changeStatusNow');
});

/*guidance*/
    Route::post('api/autoLogin' , 'FrontEnd\UserController@apiAutoLogin');









Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');
