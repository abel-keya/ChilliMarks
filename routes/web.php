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

/*	Sign in Routes
|--------------------------------------------------------------------------| */
Route::get('/',                    ['uses' => 'Home\HomeController@index']);


/*	Examinations Routes
|--------------------------------------------------------------------------| */
Route::get('exams',                ['uses' => 'Core\Exams\ExamsController@index']);

Route::post('search-exams',        ['uses' => 'Core\Exams\ExamsController@search']);

Route::get('view-exam/{id}',       ['uses' => 'Core\Exams\ExamsController@view']);

Route::post('create-exam',         ['uses' => 'Core\Exams\ExamsController@create']);

Route::get('edit-exam/{id}',       ['uses' => 'Core\Exams\ExamsController@edit']);

Route::post('update-exam/{id}',    ['uses' => 'Core\Exams\ExamsController@update']);

Route::get('confirm-exam/{id}',    ['uses' => 'Core\Exams\ExamsController@confirm']);

Route::post('delete-exam/{id}',    ['uses' => 'Core\Exams\ExamsController@delete']);


/*	Classes Routes
|--------------------------------------------------------------------------| */
Route::get('classes',              ['uses' => 'Core\Classes\ClassesController@index']);

Route::post('search-classes',      ['uses' => 'Core\Classes\ClassesController@search']);

Route::get('view-class/{id}',      ['uses' => 'Core\Classes\ClassesController@view']);

Route::post('create-class',        ['uses' => 'Core\Classes\ClassesController@create']);

Route::get('edit-class/{id}',      ['uses' => 'Core\Classes\ClassesController@edit']);

Route::post('update-class/{id}',   ['uses' => 'Core\Classes\ClassesController@update']);

Route::get('confirm-class/{id}',   ['uses' => 'Core\Classes\ClassesController@confirm']);

Route::post('delete-class/{id}',   ['uses' => 'Core\Classes\ClassesController@delete']);


/*	Students Routes
|--------------------------------------------------------------------------| */
Route::get('students',             ['uses' => 'Core\Students\StudentsController@index']);

Route::post('search-students',     ['uses' => 'Core\Students\StudentsController@search']);

Route::get('view-student/{id}',    ['uses' => 'Core\Students\StudentsController@view']);

Route::post('create-student',      ['uses' => 'Core\Students\StudentsController@create']);

Route::get('edit-student/{id}',    ['uses' => 'Core\Students\StudentsController@edit']);

Route::post('update-student/{id}', ['uses' => 'Core\Students\StudentsController@update']);

Route::get('confirm-student/{id}', ['uses' => 'Core\Students\StudentsController@confirm']);

Route::post('delete-student/{id}', ['uses' => 'Core\Students\StudentsController@delete']);


/*	Teachers Routes
|--------------------------------------------------------------------------| */
Route::get('teachers',             ['uses' => 'Core\Teachers\TeachersController@index']);

Route::post('search-teachers',     ['uses' => 'Core\Teachers\TeachersController@search']);

Route::get('view-teacher/{id}',    ['uses' => 'Core\Teachers\TeachersController@view']);

Route::post('create-teacher',      ['uses' => 'Core\Teachers\TeachersController@create']);

Route::get('edit-teacher/{id}',    ['uses' => 'Core\Teachers\TeachersController@edit']);

Route::post('update-teacher/{id}', ['uses' => 'Core\Teachers\TeachersController@update']);

Route::get('confirm-teacher/{id}', ['uses' => 'Core\Teachers\TeachersController@confirm']);

Route::post('delete-teacher/{id}', ['uses' => 'Core\Teachers\TeachersController@delete']);


/*	Messaging Routes
|--------------------------------------------------------------------------| */
Route::get('messages',             ['uses' => 'Core\Messaging\MessagingController@index']);

Route::post('search-messages',     ['uses' => 'Core\Messaging\MessagingController@search']);

Route::get('academic-messaging',   ['uses' => 'Core\Messaging\MessagingController@academic']);

Route::get('past-messages',        ['uses' => 'Core\Messaging\MessagingController@past']);

Route::post('send-messages',       ['uses' => 'Core\Messaging\MessagingController@send']);

Route::get('view-message/{id}',    ['uses' => 'Core\Messaging\MessagingController@view']);


/*	Reports Routes
|--------------------------------------------------------------------------| */
Route::get('reports',              ['uses' => 'Core\Reports\ReportsController@index']);
 
Route::get('student-reports',      ['uses' => 'Core\Reports\ReportsController@students']);

Route::post('student-reports',     ['uses' => 'Core\Reports\ReportsController@poststudents']);

Route::get('classes-reports',      ['uses' => 'Core\Reports\ReportsController@classes']);

Route::post('classes-reports',     ['uses' => 'Core\Reports\ReportsController@postclasses']);


/*	Settings Routes
|--------------------------------------------------------------------------| */
Route::get('settings',             ['uses' => 'Core\Settings\SettingsController@index']);

Route::get('about',                ['uses' => 'Core\Settings\SettingsController@about']);

Route::get('classes-settings',      ['uses' => 'Core\Settings\SettingsController@classes']);


/*	School Routes
|--------------------------------------------------------------------------| */

Route::get('school',               ['uses' => 'Core\School\SchoolController@index']);

Route::post('student-reports',     ['uses' => 'Core\School\SchoolController@update']);
