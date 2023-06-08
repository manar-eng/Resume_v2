<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Home\HomeSliderController;
use App\Http\Controllers\Home\AboutController;
use App\Http\Controllers\Home\PortfolioController;
use App\Http\Controllers\Home\BlogGategoryController;
use App\Http\Controllers\Home\BlogController;
use App\Http\Controllers\Home\FooterController;
use App\Http\Controllers\Home\ContectController;



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
//     return view('frontend/index');
// });



// Admin all route
Route::middleware(['auth'])->group(function () {
    

Route::controller(AdminController::class)->group(function(){
    Route::get('/logout','destroy')->name('admin.logout');
    Route::get('/profile','profile')->name('admin.profile');
    Route::get('/edite/profile','editprofile')->name('edit.profile');
    Route::post('/sorte/profile','sorteprofile')->name('sorte.profile');
    Route::get('/changepassword','changepassword')->name('change.password');
    Route::post('/updatepassword','updatepassword')->name('update.password');
    Route::get('/','Home')->name('home');

});

});

// home all route
Route::middleware(['auth'])->group(function () {
Route::controller(HomeSliderController::class)->group(function(){
     Route::get('/home/slide','HomeSlider')->name('home.slide');
     Route::post('/update/slide','UpdateSlider')->name('update.slider');
});
});

// about all route
Route::middleware(['auth'])->group(function () {

Route::controller(AboutController::class)->group(function(){
    Route::get('/about/page','aboutpage')->name('about.page');
    Route::post('/update/about','updateabout')->name('update.about');
    Route::get('/about','homeabout')->name('home.about');
    Route::get('/about/multi/image','aboutmultiimage')->name('about.multi.image');
    Route::post('/store/multi/image','StoreMultiImage')->name('store.multi.image');
    Route::get('/all/multi/image','AllMultiImage')->name('all.multi.image');
    Route::get('/edit/multi/image/{id}','EditMultiImage')->name('edit.multi.image');
    Route::post('/update/multi/image','UpdateMultiImage')->name('update.multi.image');
    Route::get('/delete/multi/image/{id}','DeleteMultiImage')->name('delete.multi.image');

});
});

// portfolio all route
Route::middleware(['auth'])->group(function () {

Route::controller(PortfolioController::class)->group(function(){
    Route::get('/all/portfolio','AllPortfolio')->name('all.portfolio');
    Route::get('/add/portfolio','AddPortfolio')->name('add.portfolio');
    Route::post('/store/portfolio','StorePortfolio')->name('store.portfolio');
    Route::get('/edit/portfolio/{id}','EditPortfolio')->name('edit.portfolio');
    Route::post('/update/portfolio','UpdatePortfolio')->name('update.portfolio');
    Route::get('/delete/portfolio/{id}','DeletePortfolio')->name('delete.portfolio');
    Route::get('/details/portfolio/{id}','PortfolioDetails')->name('portfolio.details');
    Route::get('/portfolio','HomePortfolio')->name('home.portfolio');

});
});


//blog gategory all route
Route::middleware(['auth'])->group(function () {

Route::controller(BlogGategoryController::class)->group(function(){
    Route::get('/all/blog/gategory','AllBlogGategory')->name('all.blog.gategory');
    Route::get('/add/blog/gategory','AddBlogGategory')->name('add.blog.gategory');
    Route::post('/store/blog/gategory','StoreBlogGategory')->name('store.blog.gategory');
    Route::get('/edit/blog/gategory/{id}','EditBlogGategory')->name('edit.blog.gategory');
    Route::post('/update/blog/gategory','UpdateBlogGategory')->name('update.blog.gategory');
    Route::get('/delete/blog/gategory{id}','DeleteBlogGategory')->name('delete.blog.gategory');


});
});


// blog all route
Route::middleware(['auth'])->group(function () {

Route::controller(BlogController::class)->group(function(){
    Route::get('/all/blog','AllBlog')->name('all.blog');
    Route::get('/add/blog','AddBlog')->name('add.blog');
    Route::post('/store/blog','StoreBlog')->name('store.blog');
    Route::get('/edit/blog/{id}','EditBlog')->name('edit.blog');
    Route::post('/update/blog','UpdateBlog')->name('update.blog');
    Route::get('/delete/blog/{id}','DeleteBlog')->name('delete.blog');
    Route::get('/blog/details/{id}','BlogDetails')->name('blog.details');
    Route::get('/category/blog/{id}','CategoryBlog')->name('category.blog');
    Route::get('/blog','HomeBlog')->name('home.blog');


});
});


// footer all route
Route::middleware(['auth'])->group(function () {

Route::controller(FooterController::class)->group(function(){
    Route::get('/footer/setup','FooterSetup')->name('footer.setup');
    Route::post('/update/footer','UpdateFooter')->name('update.footer');


});
});

//contact all route
Route::middleware(['auth'])->group(function () {

Route::controller(ContectController::class)->group(function(){
    Route::get('/contact','Contact')->name('contact.me');
    Route::post('/store/massage','StoreMassage')->name('store.massage');
    Route::get('/contact/message','ContactMessage')->name('contact.message');
    Route::get('/delete/message/{id}','DeleteMessage')->name('delete.massage');


});
});


Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth','verified'])->name('dashboard');

require __DIR__.'/auth.php';
