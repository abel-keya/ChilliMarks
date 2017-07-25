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
Route::get('/',                    ['uses' => 'Auth\LoginController@index'])->name('signin');

Route::post('signin',              ['uses' => 'Auth\LoginController@signin']);

Route::get('signout',              ['uses' => 'Auth\LoginController@signout']);

/*	Examinations Routes
|--------------------------------------------------------------------------| */
Route::get('exams',                ['uses' => 'Core\Exams\ExamsController@index'])->name('home');

Route::post('search-exams',        ['uses' => 'Core\Exams\ExamsController@search']);

Route::get('view-exam/{id}',       ['uses' => 'Core\Exams\ExamsController@view'])->name('view-exam');

Route::get('create-exam',          ['uses' => 'Core\Exams\ExamsController@create']);

Route::post('create-exam',         ['uses' => 'Core\Exams\ExamsController@postcreate']);

Route::get('edit-exam/{id}',       ['uses' => 'Core\Exams\ExamsController@edit']);

Route::post('update-exam/{id}',    ['uses' => 'Core\Exams\ExamsController@update']);

Route::get('confirm-exam/{id}',    ['uses' => 'Core\Exams\ExamsController@confirm']);

Route::post('delete-exam/{id}',    ['uses' => 'Core\Exams\ExamsController@delete']);

/*	Assessment Routes
|--------------------------------------------------------------------------| */

Route::get('view-assessment/{id}',       ['uses' => 'Core\Exams\AssessmentsController@view'])->name('view-assessment');

Route::get('create-assessment/{id}',     ['uses' => 'Core\Exams\AssessmentsController@create']);

Route::post('create-assessment/{id}',         ['uses' => 'Core\Exams\AssessmentsController@postcreate']);

Route::get('edit-assessment/{id}',       ['uses' => 'Core\Exams\AssessmentsController@edit']);

Route::post('update-assessment/{id}',    ['uses' => 'Core\Exams\AssessmentsController@update']);

Route::get('confirm-assessment/{id}',    ['uses' => 'Core\Exams\AssessmentsController@confirm']);

Route::post('delete-assessment/{id}',    ['uses' => 'Core\Exams\AssessmentsController@delete']);

/*	Grades Routes
|--------------------------------------------------------------------------| */
Route::get('edit-grade/{id}',             ['uses' => 'Core\Exams\GradesController@edit']);
 
Route::post('update-grade/{id}',          ['uses' => 'Core\Exams\GradesController@update']);

Route::get('view-grades/{id}',            ['uses' => 'Core\Exams\GradesController@view'])->name('view-grades');

Route::get('confirm-grade/{id}',          ['uses' => 'Core\Exams\GradesController@confirm']);

Route::post('delete-grade/{id}',          ['uses' => 'Core\Exams\GradesController@delete']);

Route::get('view-teacher-grades/{id}',    ['uses' => 'Core\Exams\GradesController@grades'])->name('view-teacher-grades');

Route::post('submit-grades/{id}',         ['uses' => 'Core\Exams\GradesController@postgrades']);

Route::get('create-select-grades/{id}',   ['uses' => 'Core\Exams\GradesController@createselect'])->name('create-select-grades');

Route::post('create-select-grades/{id}',  ['uses' => 'Core\Exams\GradesController@postcreateselect']);

/*	Classes Routes
|--------------------------------------------------------------------------| */
Route::get('classes',              ['uses' => 'Core\Classes\ClassesController@index']);

Route::post('search-classes',      ['uses' => 'Core\Classes\ClassesController@search']);

Route::get('view-class/{id}',      ['uses' => 'Core\Classes\ClassesController@view'])->name('view-class');

Route::get('create-class',         ['uses' => 'Core\Classes\ClassesController@create']);

Route::post('create-class',        ['uses' => 'Core\Classes\ClassesController@postcreate']);

Route::get('edit-class/{id}',      ['uses' => 'Core\Classes\ClassesController@edit']);

Route::post('update-class/{id}',   ['uses' => 'Core\Classes\ClassesController@update']);

Route::get('confirm-class/{id}',   ['uses' => 'Core\Classes\ClassesController@confirm']);

Route::post('delete-class/{id}',   ['uses' => 'Core\Classes\ClassesController@delete']);

/*	Stream Routes
|--------------------------------------------------------------------------| */

Route::get('view-stream/{id}',      ['uses' => 'Core\Streams\StreamsController@view']);

Route::get('create-stream/{id}',    ['uses' => 'Core\Streams\StreamsController@create']);

Route::post('create-stream/{id}',   ['uses' => 'Core\Streams\StreamsController@postcreate']);

Route::get('edit-stream/{id}',      ['uses' => 'Core\Streams\StreamsController@edit']);

Route::post('update-stream/{id}',   ['uses' => 'Core\Streams\StreamsController@update']);

Route::get('confirm-stream/{id}',   ['uses' => 'Core\Streams\StreamsController@confirm']);

Route::post('delete-stream/{id}',   ['uses' => 'Core\Streams\StreamsController@delete']);


/*	Students Routes
|--------------------------------------------------------------------------| */
Route::get('students',             ['uses' => 'Core\Students\StudentsController@index']);

Route::post('search-students',     ['uses' => 'Core\Students\StudentsController@search']);

Route::get('view-student/{id}',    ['uses' => 'Core\Students\StudentsController@view'])->name('view-student');

Route::get('create-student',       ['uses' => 'Core\Students\StudentsController@create']);

Route::post('create-student',      ['uses' => 'Core\Students\StudentsController@postcreate']);

Route::get('edit-student/{id}',    ['uses' => 'Core\Students\StudentsController@edit']);

Route::post('update-student/{id}', ['uses' => 'Core\Students\StudentsController@update']);

Route::get('confirm-student/{id}', ['uses' => 'Core\Students\StudentsController@confirm']);

Route::post('delete-student/{id}', ['uses' => 'Core\Students\StudentsController@delete']);

Route::get('student-bulk-actions', ['uses' => 'Core\Students\StudentsController@bulkactions']);

Route::get('student-bulk-delete',  ['uses' => 'Core\Students\StudentsController@bulkdelete']);

Route::post('student-bulk-delete', ['uses' => 'Core\Students\StudentsController@postbulkdelete']);


/*	Teachers Routes
|--------------------------------------------------------------------------| */
Route::get('teachers',             ['uses' => 'Core\Teachers\TeachersController@index']);

Route::post('search-teachers',     ['uses' => 'Core\Teachers\TeachersController@search']);

Route::get('view-teacher/{id}',    ['uses' => 'Core\Teachers\TeachersController@view'])->name('view-teacher');

Route::get('create-teacher',       ['uses' => 'Core\Teachers\TeachersController@create']);

Route::post('create-teacher',      ['uses' => 'Core\Teachers\TeachersController@postcreate']);

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

Route::get('select-group/{id}',    ['uses' => 'Core\Groups\ManageGroupsController@selectGroup']);

Route::get('view-message/{id}',    ['uses' => 'Core\Messaging\MessagingController@view']);


/*	Reports Routes
|--------------------------------------------------------------------------| */
Route::get('reports',              ['uses' => 'Core\Reports\ReportsController@index']);
 
Route::get('report-forms',         ['uses' => 'Core\Reports\ReportsController@reportforms']);

Route::post('report-forms',        ['uses' => 'Core\Reports\ReportsController@postreportform']);

Route::get('stream-reports',       ['uses' => 'Core\Reports\ReportsController@streamreports']);

Route::post('stream-report',       ['uses' => 'Core\Reports\ReportsController@poststreamreport']);

Route::get('overall-class-reports',       ['uses' => 'Core\Reports\ReportsController@overallclassreports']);

Route::post('overall-class-report',       ['uses' => 'Core\Reports\ReportsController@postoverallclassreport']);

Route::get('group-reports',        ['uses' => 'Core\Reports\ReportsController@groupreports']);

Route::post('group-report',        ['uses' => 'Core\Reports\ReportsController@postgroupreports']);

Route::post('student-reports',     ['uses' => 'Core\Reports\ReportsController@poststudents']);

Route::get('classes-reports',      ['uses' => 'Core\Reports\ReportsController@classes']);

Route::post('classes-reports',     ['uses' => 'Core\Reports\ReportsController@postclasses']);


/*	Settings Routes
|--------------------------------------------------------------------------| */
Route::get('settings',             ['uses' => 'Core\Settings\SettingsController@index']);

Route::get('about',                ['uses' => 'Core\Settings\SettingsController@about']);

Route::get('license',              ['uses' => 'Core\Settings\SettingsController@license']);


/*	Groups Routes
|--------------------------------------------------------------------------| */

Route::get('groups',               ['uses' => 'Core\Groups\GroupsController@index']);

Route::post('search-groups',       ['uses' => 'Core\Groups\GroupsController@search']);

Route::get('view-group/{id}',      ['uses' => 'Core\Groups\GroupsController@view'])->name('view-group');

Route::get('create-group',         ['uses' => 'Core\Groups\GroupsController@create']);

Route::post('create-group',        ['uses' => 'Core\Groups\GroupsController@postcreate']);

Route::get('edit-group/{id}',      ['uses' => 'Core\Groups\GroupsController@edit']);

Route::post('update-group/{id}',   ['uses' => 'Core\Groups\GroupsController@update']);

Route::get('confirm-group/{id}',   ['uses' => 'Core\Groups\GroupsController@confirm']);

Route::post('delete-group/{id}',   ['uses' => 'Core\Groups\GroupsController@delete']);


/*	Assign / Detach Groups Routes
|--------------------------------------------------------------------------| */

Route::get('select-attach-group/{id}',   ['uses' => 'Core\Groups\ManageGroupsController@selectAttachGroup']);

Route::post('assign-group/{id}',         ['uses' => 'Core\Groups\ManageGroupsController@assignGroup']);

Route::get('select-detach-group/{id}',   ['uses' => 'Core\Groups\ManageGroupsController@selectDetachGroup']);

Route::post('detach-group/{id}',         ['uses' => 'Core\Groups\ManageGroupsController@detachGroup']);

Route::get('assign-group-many',          ['uses' => 'Core\Groups\ManageGroupsController@assignmany']);

Route::post('assign-group-many',         ['uses' => 'Core\Groups\ManageGroupsController@postassignmany']);

Route::get('detach-group-many',          ['uses' => 'Core\Groups\ManageGroupsController@detachmany']);

Route::post('detach-group-many',         ['uses' => 'Core\Groups\ManageGroupsController@postdetachmany']);


/*	Assign / Detach Streams Routes
|--------------------------------------------------------------------------| */
Route::get('manage-stream',              ['uses' => 'Core\Streams\ManageStreamsController@index']);

Route::get('select-attach-stream/{id}',  ['uses' => 'Core\Streams\ManageStreamsController@selectAttachStream']);

Route::post('assign-stream/{id}',        ['uses' => 'Core\Streams\ManageStreamsController@assignStream']);

Route::get('select-detach-stream/{id}',  ['uses' => 'Core\Streams\ManageStreamsController@selectDetachStream']);

Route::post('detach-stream/{id}',        ['uses' => 'Core\Streams\ManageStreamsController@detachStream']);

Route::get('assign-stream-many',         ['uses' => 'Core\Streams\ManageStreamsController@assignmany']);

Route::post('assign-stream-many',        ['uses' => 'Core\Streams\ManageStreamsController@postassignmany']);

Route::get('detach-stream-many',         ['uses' => 'Core\Streams\ManageStreamsController@detachmany']);

Route::post('detach-stream-many',        ['uses' => 'Core\Streams\ManageStreamsController@postdetachmany']);


/*	Classes Settings
|--------------------------------------------------------------------------| */
Route::get('classes-settings',           ['uses' => 'Core\Classes\ManageStreamsController@index']);

Route::get('manage-streams',             ['uses' => 'Core\Classes\ManageStreamsController@streams']);


/*	Group Settings
|--------------------------------------------------------------------------| */
Route::get('groups-settings',            ['uses' => 'Core\Groups\ManageGroupsController@index']);

Route::get('manage-groups',              ['uses' => 'Core\Groups\ManageGroupsController@groups']);


/*	School Routes
|--------------------------------------------------------------------------| */

Route::get('school',                     ['uses' => 'Core\School\SchoolController@index']);

Route::post('student-reports',           ['uses' => 'Core\School\SchoolController@update']);


/*	Teacher Classes Routes
|--------------------------------------------------------------------------| */

Route::get('teacher-exams',              ['uses' => 'Teachers\Exams\ExamsController@index']);


/*	School Routes
|--------------------------------------------------------------------------| */

Route::get('import-students',            ['uses' => 'Core\Students\StudentsController@import']);

Route::post('import-students',           ['uses' => 'Core\Students\StudentsController@postimport']);

Route::get('import-student-template',    ['uses' => 'Core\Students\StudentsController@importtemplate']);
