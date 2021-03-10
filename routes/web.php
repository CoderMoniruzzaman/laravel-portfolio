<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

//frontend route

Route::get('/', 'Frontend\HomeController@index');
Route::get('resume', 'Frontend\ResumeController@index');
Route::get('portfolio', 'Frontend\PortfolioController@index')->name('portfolio');
Route::get('workdetails/{id}', 'Frontend\PortfolioController@portfolioindex')->name('workdetails');
Route::get('freelance', 'Frontend\FreelanceController@index');
Route::get('blog', 'Frontend\BlogController@index');
//CONTACT
Route::get('contact', 'Frontend\ContactController@index');
Route::post('contact/send', 'Frontend\ContactController@contactinsert');






    // Route::get('/blogdestails', 'Frontend\HomeController@index');

// Route::get('/', function () {
//     return view('frontend/page/home');
// });
//admin route
Auth::routes();
Route::group(['prefix' => 'admin'],function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('admin.dashboard');
    //category
    Route::resource('category','Backend\CategoryController',['names' => 'admin.category'])->middleware('auth');
    Route::post('category/update', 'Backend\CategoryController@categoryupdate')->name('admin.category.data.update')->middleware('auth');
    Route::get('category/delete/data/{cat_id}', 'Backend\CategoryController@categorydelete')->middleware('auth');
    Route::get('category/status/{cat_id}', 'Backend\CategoryController@changestatus')->middleware('auth');
    //workskill
    Route::resource('workskill', 'Backend\WorkskillController',['names' => 'admin.work.skill'])->middleware('auth');
    Route::post('work/skill/update', 'Backend\WorkskillController@skillupdate')->name('admin.work.skill.data.update')->middleware('auth');
    Route::get('work/skill/data/{s_id}', 'Backend\WorkskillController@skilldelete')->middleware('auth');
    Route::get('workskill/status/{s_id}', 'Backend\WorkskillController@skillstatus')->middleware('auth');
    //work
    Route::resource('work','Backend\WorkController',['names' => 'admin.work'])->middleware('auth');
    Route::post('/edit/work/','Backend\WorkController@update')->middleware('auth');
    Route::post('/edit/work/single/{single_photo}/{single_id}','Backend\WorkController@editproductsingle')->middleware('auth');
    Route::get('/delete/work/single/{single_photo}/{single_id}','Backend\WorkController@deleteproductsingle')->middleware('auth');
    Route::get('/change/status/project/{id}', 'Backend\WorkController@changestatus')->middleware('auth');
    Route::get('project/delete/{id}', 'Backend\WorkController@destroy')->middleware('auth');
    //conact
    Route::resource('contact','Backend\ContactController',['names' => 'admin.contact'])->middleware('auth');
    Route::get('contact/emailview/{id}', 'Backend\ContactController@readmessagestatus')->name('admin.contact.emailview')->middleware('auth');
    //homepage
    Route::get('personalinfo/view', 'Backend\PersonalinfoController@personalview')->name('admin.personalinfo.view')->middleware('auth');
    Route::get('personalinfo/edit/{id}', 'Backend\PersonalinfoController@personaledit')->name('admin.personalinfo.edit')->middleware('auth');
    Route::post('personalinfo/update', 'Backend\PersonalinfoController@personalupdate')->name('admin.personalinfo.update')->middleware('auth');
    Route::get('file/download/{id}', 'Backend\PersonalinfoController@downloadcv');
    //Social-link
    Route::resource('sociallink','Backend\SociallinkController',['names' => 'admin.sociallink'])->middleware('auth');
    Route::post('sociallink/update', 'Backend\SociallinkController@socialupdate')->name('admin.socail.update')->middleware('auth');
    Route::get('sociallink/delete/data/{so_id}', 'Backend\SociallinkController@socaildelete')->middleware('auth');
    Route::get('sociallink/status/{so_id}', 'Backend\SociallinkController@socailstatus')->middleware('auth');
    //service
    Route::resource('service','Backend\ServiceController',['names' => 'admin.service'])->middleware('auth');
    Route::post('service/update', 'Backend\ServiceController@serviceupdate')->name('admin.servicedata.update')->middleware('auth');
    Route::get('service/delete/data/{sa_id}', 'Backend\ServiceController@servicedelete')->middleware('auth');
    Route::get('service/status/{so_id}', 'Backend\ServiceController@servicestatus')->middleware('auth');
    //education
    Route::resource('education','Backend\EducationController',['names' => 'admin.education'])->middleware('auth');
    Route::post('education/update', 'Backend\EducationController@educationupdate')->name('admin.educationdata.update')->middleware('auth');
    Route::get('education/delete/data/{edu_id}', 'Backend\EducationController@educationdelete')->middleware('auth');
    Route::get('education/status/{edu_id}', 'Backend\EducationController@educationstatus')->middleware('auth');
    //Experience
    Route::resource('experience','Backend\ExperienceController',['names' => 'admin.experience'])->middleware('auth');
    Route::post('experience/update', 'Backend\ExperienceController@experienceupdate')->name('admin.experiencedata.update')->middleware('auth');
    Route::get('experience/delete/data/{exp_id}', 'Backend\ExperienceController@experiencedelete')->middleware('auth');
    Route::get('experience/status/{exp_id}', 'Backend\ExperienceController@experiencestatus')->middleware('auth');
    //skillknowledge
    Route::resource('skillknowledge','Backend\SkillKnowledgeController',['names' => 'admin.skillknowledge'])->middleware('auth');
    Route::post('skillknowledge/update', 'Backend\SkillKnowledgeController@skillknowledgeupdate')->name('admin.skillknowledgedata.update')->middleware('auth');
    Route::get('skillknowledge/delete/data/{sk_id}', 'Backend\SkillKnowledgeController@skillknowledgedelete')->middleware('auth');
    Route::get('skillknowledge/status/{sk_id}', 'Backend\SkillKnowledgeController@skillknowledgestatus')->middleware('auth');
    //freelancee
    Route::resource('freelanceesite','Backend\FreelanceController',['names' => 'admin.freelanceesite'])->middleware('auth');
    Route::get('freelanceesite/delete/{id}', 'Backend\FreelanceController@destroy')->middleware('auth');
    Route::get('change/status/freelance/{id}', 'Backend\FreelanceController@status')->middleware('auth');
    //Achievement
    Route::resource('achievementsite','Backend\AchievementController',['names' => 'admin.achievementsite'])->middleware('auth');
    Route::get('achievementsite/delete/{id}', 'Backend\AchievementController@destroy')->middleware('auth');
    Route::get('change/status/achievement/{id}', 'Backend\AchievementController@status')->middleware('auth');
    //Research
    Route::resource('researchsite','Backend\ResearchController',['names' => 'admin.researchsite'])->middleware('auth');
    Route::get('researchsite/delete/{id}', 'Backend\ResearchController@destroy')->middleware('auth');
    Route::get('change/status/research/{id}', 'Backend\ResearchController@status')->middleware('auth');
    //icon
    Route::get('iconsite', 'Backend\HomepageController@icon')->name('admin.iconsite')->middleware('auth');
});

