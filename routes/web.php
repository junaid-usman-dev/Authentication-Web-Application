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

// Route::get('/', function () {
//     return view('welcome');
// });


/*
|--------------------------------------------------------------------------
| Registration
|--------------------------------------------------------------------------
|
| Here is where you can register user loaded by CustomerController
| 1 Sign up 
| 2 Sign in
| 3 reset password
| 4 Gmail integration
| 5 Facebook integration
|
*/

// signup
Route::get('/signup', 'CustomerController@create');
Route::post('/store', 'CustomerController@store');
Route::get('/verify/{username}/{key}', 'CustomerController@ListCustomer');
// end signup url code

//Signin
Route::get('/signin', 'CustomerController@index')->name('signin');
Route::post('/home', 'CustomerController@home');
//end signin url

// Logout user
Route::get('/logout','CustomerController@Logout'); 

// forget password
Route::get('/confirm-email-address', function () {
    return view('registration/Forgetpassword/confirm_email');
});

Route::post('/forgetpassword/verification', 'CustomerController@ForgetPassword'); // check username/email address
Route::get('/forgetpassword/reset/{username}/{key}', 'CustomerController@ResetPassword'); // view update page
Route::post('/password/updated/{username}/{key}/{pass}', 'CustomerController@UpdatePassword'); // updpate password
// end forget password url

// Socialite Authentication url
Route::get('login/{service}', 'CustomerController@redirectToProvider');
Route::get('login/{service}/callback', 'CustomerController@handleProviderCallback');

// add usernname for Facebook and Google user
Route::post('/username', 'CustomerController@AddUsername');

 
/*
|--------------------------------------------------------------------------
| Theme URL's
|--------------------------------------------------------------------------
|
| Here is where you can register user loaded by CustomerController
| 1 Auth User 
| 2 Create Product
| 3 Store Product
| 4 List Product
| 5 delete product
| 6 edit product
| 7 
|
*/

/*
|--------------------------------------------------------------------------
| Product URL
|--------------------------------------------------------------------------
*/

// ----------   Create Product  -----------
route::get('/create-product', 'Product\ProductController@create');
// ----------   Store Product  ------------
route::post('/store-product', 'Product\ProductController@store');
// ----------   List Product  -------------
route::get('/', 'Product\ProductController@index');
// ----------   Delete Product  -----------
route::get('/delete-product/{id}', 'Product\ProductController@destroy');
// ----------   Edit Product  -------------
route::get('/edit-product/{id}', 'Product\ProductController@edit');
route::post('/update-product', 'Product\ProductController@update');



// ------  Index URL's   -----------
// Route::get('/', function () {
//     return view('c2c/index');
// });

route::get('/avaiable/{available}', 'Product\ProductController@show');

// Route::get('/avaiable', function () {
//     return view('c2c/index-1');
// });
// ------  End index URL's   -----------

// Header URL's
Route::get('/community', function () {
    return view('/c2c/community');
});

// ------  Header URL's   -----------
Route::get('/for-you', function () {
    return view('/c2c/for-you');
});


/*
|--------------------------------------------------------------------------
| Star Rank URL
|--------------------------------------------------------------------------
*/

// ----------- Star Ranking  ----------

route::get('/create-startrank', 'StartRank\StartRankController@create');
route::post('/store-startrank', 'StartRank\StartRankController@store');
route::get('/edit-startrank/{id}', 'StartRank\StartRankController@edit');
route::post('/update-startrank', 'StartRank\StartRankController@update');


route::get('/start-ranking', 'StartRank\StartRankController@ThisMonth');
route::get('/this-week', 'StartRank\StartRankController@ThisWeek');

route::get('/detele-startrank/{id}', 'StartRank\StartRankController@destroy');




// Route::get('/start-ranking', function () {
//     return view('/c2c/start-ranking');
// });
Route::get('/ranking', function () {
    return view('/c2c/ranking');
});
Route::get('/ranking-1', function () {
    return view('/c2c/ranking-1');
});
Route::get('/ranking-2', function () {
    return view('/c2c/ranking-2');
});

// Create Post
Route::get('/create-a-post', function () {
    return view('/c2c/create-a-post');
});
// Community all post
Route::get('/community-new-post', function () {
    return view('/c2c/community-new-post');
});
// Community single post
Route::get('/community-single-post', function () {
    return view('/c2c/community-single-post');
});
// Community all post
Route::get('/community-all-posts', function () {
    return view('/c2c/community-all-posts');
});
// profile looks
Route::get('/profile-looks', function () {
    return view('/c2c/profile-looks');
});
Route::get('/profile-posts', function () {
    return view('/c2c/profile-posts');
});
// Single look
Route::get('/single-look', function () {
    return view('/c2c/single-look');
});
// Single product details
Route::get('/single-product-details', function () {
    return view('/c2c/single-product-details');
});
// ------- End header URL's  --------




