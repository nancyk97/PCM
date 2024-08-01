<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CommentController;

// Group routes under the 'api' middleware and prefix
Route::middleware('api')->group(function () {
    Route::get('/comments', [CommentController::class, 'index'])->name('comments.index');
    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::get('/comments/{id}', [CommentController::class, 'show'])->name('comments.show');
    Route::put('/comments/{id}', [CommentController::class, 'update'])->name('comments.update');
    Route::delete('/comments/{id}', [CommentController::class, 'destroy'])->name('comments.destroy');
    Route::get('/posts/{postId}/comments', [CommentController::class, 'getCommentsByPostId'])->name('comments.byPostId');
});
