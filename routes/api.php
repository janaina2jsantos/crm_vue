<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Upcoming;
use App\Models\Today;
use App\Http\Resources\UpcomingTaskResource;
use App\Http\Resources\TodayTaskResource;
use Illuminate\Support\Facades\DB;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// *** Upcoming Tasks
// Get all the tasks
Route::get('/upcoming', function() {
    $tasks = Upcoming::all();
    return UpcomingTaskResource::collection($tasks);
});

// Add a new task
Route::post('/upcoming', function(Request $request) {
    $task = Upcoming::create([
        'task_id' => $request->task_id,
        'title'   => $request->title,
        'waiting' => $request->waiting
    ]);
    return $task;
});

// Delete task
Route::delete('/upcoming/{id}', function($id) {
    $task = DB::table('upcomings')->where('id', '=', $id);

    if (!$task->count() > 0) {
        return "Record not found!";
    }

    $task->delete();
    return "Deleted successfully!";
});

// ==============================

// *** Today Tasks
// Get all the tasks
Route::get('/today', function() {
    $tasks = Today::all();
    return TodayTaskResource::collection($tasks);
});

// Add a new task
Route::post('/today', function(Request $request) {
    $task = Today::create([
        'task_id' => $request->task_id,
        'title'   => $request->title
    ]);
    return $task;
});

// Edit task
Route::put('/today/{id}', function($id) {
    $task = Today::where('id', '=', $id)->update([
        'completed' => 1
    ]);
    return "Updated successfully!";
});

// Delete task
Route::delete('/today/{id}', function($id) {
    $task = DB::table('todays')->where('id', '=', $id);

    if (!$task->count() > 0) {
        return "Record not found!";
    }

    $task->delete();
    return "Deleted successfully!";
});