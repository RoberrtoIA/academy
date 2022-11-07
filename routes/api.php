<?php

use App\Http\Controllers\V1\AuthController;
use App\Http\Controllers\V1\HomeworkController;
use App\Http\Controllers\V1\ModuleController;
use App\Http\Controllers\V1\ProgramController;
use App\Http\Controllers\V1\TopicController;
use App\Http\Controllers\V1\User\CreateEmployeeAccountController;
use App\Http\Controllers\V1\User\CreateTraineeAccountController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::name('api.v1.')->prefix('v1')->group(function () {

    Route::post('login', [AuthController::class, 'login'])->name('login');

    Route::group(['middleware' => ['auth:sanctum']], function () {

        Route::get('/programs/tags', [ProgramController::class, 'tag'])
            ->middleware(['ability:manage_programs']);

        Route::resource('programs', ProgramController::class)
            ->except(['index', 'show'])
            ->middleware(['ability:manage_programs']);

        Route::resource('programs', ProgramController::class)
            ->only(['index', 'show'])
            ->middleware([
                'ability:manage_programs'
                    . ',see_program_content_details'
                    . ',see_program_content'
            ]);

        Route::resource('modules', ModuleController::class)
            ->except(['index', 'show'])
            ->middleware(['ability:manage_modules']);

        Route::resource('modules', ModuleController::class)
            ->only(['index', 'show'])
            ->middleware([
                'ability:manage_modules'
                    . ',see_module_content_details'
                    . ',see_module_content'
            ]);

        Route::resource('topics', TopicController::class)
            ->except(['index', 'show'])
            ->middleware(['ability:manage_topics']);

        Route::resource('topics', TopicController::class)
            ->only(['index', 'show'])
            ->middleware([
                'ability:manage_topics'
                    . ',see_topic_content_details'
                    . ',see_topic_content'
            ]);

        Route::resource('homeworks', HomeworkController::class)
            ->except(['index', 'show'])
            ->middleware(['ability:manage_homeworks_questions']);

        Route::resource('homeworks', HomeworkController::class)
            ->only(['index', 'show'])
            ->middleware([
                'ability:manage_homeworks_questions'
                    . ',see_homework_question_content_details'
                    . ',see_homework_question_content'
            ]);

        Route::post('users/create-trainee-account', CreateTraineeAccountController::class)
            ->name('users.createTraineeAccount')
            ->middleware(['ability:manage_user_accounts']);

        Route::post('users/create-employee-account', CreateEmployeeAccountController::class)
            ->name('users.createEmployeeAccount')
            ->middleware(['ability:manage_user_accounts']);
    });
});
