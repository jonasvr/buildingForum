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

Route::get('/', function () {
    $threads = App\Thread::paginate(15);
    return view('welcome', compact('threads'));
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/threads/search', 'ThreadController@search')->name('threads.search');
Route::post('/threads/mark-as-solution', 'ThreadController@markAsSolution')->name('markAsSolution');
Route::resource('/threads', 'ThreadController');

Route::resource('/comments', 'CommentController', ['only' => ['update', 'destroy']]);
Route::post('comments/create/{thread}', 'CommentController@addThreadComment')->name('threadcomment.store');
Route::post('replies/create/{comment}', 'CommentController@addReplyComment')->name('replycomment.store');
Route::post('comments/like', 'LikeController@toggleLike')->name('toggleLike');

Route::get('/user/profile/{user}', 'UserProfileController@index')->name('user_profile')->middleware('auth');

Route::get('/markAsRead', function () {
    auth()->user()->unreadNotifications->markAsRead();
});

Route::resource('/admin', 'AdminController');
