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
Route::get('send_test_email', function(){
	Mail::raw('Sending emails with Mailgun and Laravel is easy!', function($message)
	{
		$message->subject('Mailgun and Laravel are awesome!');
		$message->from('admin@playthriftgift.com', 'playthriftgift.com');
		$message->to('kcc_odj@outlook.com');
	});
});
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('route:cache');
    // return what you want
});
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/faq', function () {
    return view('faq');
})->name('faq');
Route::get('/logout', function () {
    return view('welcome');
});
Route::get('/playdemo', function(){
    return view('demo');
})->name('demo');
    

Route::get('/markAsRead', function () {
    Auth::user()->unreadNotifications->markAsRead();
})->name('markAsRead');


Auth::routes();

Route::get('/auth/redirect/{provider}', 'SocialController@redirect');
Route::get('/callback/{provider}', 'SocialController@callback');


Route::get('/home', 'HomeController@index')->name('home');
Route::get('/verifyemail','WelcomeController@verifyEmail')->name('verifyemail');
Route::get('/lostpass',function(){
    return view('lostpass');
});
Route::post('/lostpass','WelcomeController@lostPassword')->name('lostpass');//send mail for reset password link
Route::get('/passwordreset','WelcomeController@passwordReset')->name('passwordreset');
Route::post('/passwordreset','WelcomeController@passwordResetConfirm')->name('passwordreset');

Route::get('/home/dashboard', 'HomeController@dashboard')->name('dashboard');
Route::get('/home/buytokenview', 'HomeController@buyTokenView')->name('buytokenview');

Route::get('invite', 'InviteController@invite')->name('invite');
Route::post('invite', 'InviteController@process')->name('process');
// {token} is a required parameter that will be exposed to us in the controller method
Route::get('/accept/{token}', 'InviteController@accept')->name('accept');

Route::get('/miscajax/buytokenconfirm', 'MiscajaxController@buyTokenVerify')->name('buytokenconfirm');

Route::get('/game/{type}', 'HomeController@showgameList')->name('game.choose');
Route::post('/miscajax/setbgmon', 'MiscajaxController@setBgmon')->name('setbgmonpost');
Route::get('/miscajax/getprizeindex', 'MiscajaxController@getPrizeIndex')->name('getprizeindex');
Route::post('/miscajax/mailToWinner', 'MiscajaxController@mailToWinner')->name('mailtowinner');
Route::get('/miscajax/getspinremains','MiscajaxController@getSpinRemains')->name('getspinremains');

Route::get('/wheel/spinroom','HomeController@spinroom')->name('wheel.spinroom');

Route::post('prize_winner', 'HomeController@winners')->name('prize.winners');


Route::get('/admin', 'Admin\PrizemngController@prizeslist')->name('admin.home');
Route::get('/admin/login', 'Admin\AdminController@loginpage')->name('admin.loginpage');
Route::post('/admin/login', 'Admin\AdminController@login')->name('admin.login');
Route::post('/admin/passwordchange', 'Admin\AdminController@passwordChange')->name('admin.passwordchange');

Route::get('/admin/logout', 'Admin\AdminController@logout')->name('admin.logout');

Route::get('/admin/users', 'Admin\UsermngController@userslist')->name('admin.users');
Route::get('/admin/userinfojson', 'Admin\UsermngController@ajaxUserInfo')->name('admin.userinfojson');
Route::post('/admin/usereditaction', 'Admin\UsermngController@ajaxUserEditAction')->name('admin.usereditaction');
Route::post('/admin/userdelete', 'Admin\UsermngController@userDelete')->name('admin.userdelete');

Route::get('/admin/prizes', 'Admin\PrizemngController@prizeslist')->name('admin.prizes');
Route::get('/admin/prizeinfojson', 'Admin\PrizemngController@ajaxPrizeInfo')->name('admin.prizeinfojson');
Route::post('/admin/prizeeditaction', 'Admin\PrizemngController@ajaxPrizeEditAction')->name('admin.prizeeditaction');
Route::post('/admin/prizedeleteaction', 'Admin\PrizemngController@ajaxPrizeDeleteAction')->name('admin.prizedeleteaction');
Route::post('/admin/prizeaddaction', 'Admin\PrizemngController@ajaxPrizeAddAction')->name('admin.prizeaddaction');
Route::post('/miscajax/imgupload', 'Admin\PrizemngController@imgUpload')->name('ajaximgupload');

Route::get('/admin/tokenbuyhistory', 'Admin\TokenmngController@tokenBuyHistory')->name('admin.tokenbuyhistory');
Route::get('/admin/transactioninfojson', 'Admin\TokenmngController@ajaxGetRow')->name('admin.transactioninfojson');
Route::post('/admin/transactionedit', 'Admin\TokenmngController@ajaxTransactionEdit')->name('admin.transactionedit');
Route::post('/admin/transactiondelete', 'Admin\TokenmngController@ajaxTransactionDelete')->name('admin.transactiondelete');

Route::get('/admin/prizewinners', 'Admin\PrizemngController@prizeWinners')->name('admin.prizewinners');

Route::get('contact-us', 'ContactUSController@contactUS')->name('contact');
Route::post('contact-us', ['as'=>'contactus.store','uses'=>'ContactUSController@contactUSPost']);