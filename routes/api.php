<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SampleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrokerController;
use App\Http\Controllers\OwnersController;
use App\Http\Controllers\PropertyDetailsController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::resource('/sample','SampleController');
Route::post('/create',[SampleController::Class, 'store']);
Route::get('/get-sample', [SampleController::Class, 'index']);
Route::get('/get-edit/{id}', [SampleController::Class, 'edit']);
Route::delete('/delete-sample/{id}', [SampleController::Class, 'destroy']);

Route::get('/get-category',[CategoryController::Class, 'getCategory']);
Route::post('/create-category',[CategoryController::Class, 'createCategory']);
Route::get('/edit-category/{id}',[CategoryController::Class, 'editCategory']);
Route::delete('/delete-category/{id}',[CategoryController::Class, 'deleteCategory']);
Route::put('/update-category/{id}',[CategoryController::Class, 'updateCategory']);

Route::get('/get-broker',[BrokerController::Class, 'getBroker']);
Route::post('/create-broker', [BrokerController::Class, 'createBroker']);
Route::get('/get-edit-broker/{id}',[BrokerController::Class, 'editBroker']);
Route::post('/update-broker/{id}',[BrokerController::Class, 'updateBroker']);
Route::delete('/delete-broker/{id}', [BrokerController::Class, 'deleteBroker']);

Route::get('/get-owner',[OwnersController::Class, 'getOwner']);
Route::post('/create-owner', [OwnersController::Class, 'createOwner']);
Route::get('/get-edit-owner/{id}',[OwnersController::Class, 'editOwner']);
Route::post('/update-owner/{id}',[OwnersController::Class, 'updateOwner']);
Route::delete('/delete-owner/{id}', [OwnersController::Class, 'deleteOwner']);

Route::get('/get-all-property',[PropertyDetailsController::Class, 'getAllProperty']);
Route::get('/get-property-details',[PropertyDetailsController::Class, 'getPropertyDetails']);
Route::post('/create-property',[PropertyDetailsController::Class, 'store']);
Route::get('/get-edit-property/{id}',[PropertyDetailsController::Class, 'editProperty']);
Route::post('/update-property/{id}',[PropertyDetailsController::Class, 'updateProperty']);
Route::delete('/delete-property/{id}',[PropertyDetailsController::Class, 'deleteProperty']);


