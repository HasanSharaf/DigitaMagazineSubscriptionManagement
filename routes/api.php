<?php

use App\Http\Controllers\ActivityLog\ActivityLogController;
use App\Http\Controllers\Article\ArticleController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Comment\CommentController;
use App\Http\Controllers\Form\FormController;
use App\Http\Controllers\FormSection\FormSectionController;
use App\Http\Controllers\Magazine\MagazineController;
use App\Http\Controllers\Payment\PaymentController;
use App\Http\Controllers\Print\PrintController;
use App\Http\Controllers\Print\PrintOutController;
use App\Http\Controllers\PrintOutTemplate\PrintOutTemplateController;
use App\Http\Controllers\PrintOutTemplateBodySection\PrintOutTemplateBodySectionController;
use App\Http\Controllers\Subscription\SubscriptionController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::apiResource('users', UserController::class);
    Route::apiResource('subscriptions', SubscriptionController::class);
    Route::apiResource('magazines', MagazineController::class);
    Route::apiResource('payments', PaymentController::class);
    Route::apiResource('articles', ArticleController::class);
    Route::apiResource('comments', CommentController::class);
    Route::patch('/comments/{id}/block', [CommentController::class, 'block']);
    
});

Route::post('login', [AuthController::class, 'login']);