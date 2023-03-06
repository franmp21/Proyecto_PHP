<?php
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReplyController;
use Illuminate\Support\Facades\Route;


Route::redirect('/', 'dashboard'); //Elimino la funcion y la cambi por 'dashboard' y cambio get por redirect para 
//que la redireccione a dashboard

Route::get('/dashboard', function () {
    $comments = \App\Models\Comment::orderBy('id', 'DESC')->paginate();
    return view('dashboard', ['comments' =>$comments]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::post('comments', [CommentController::class, 'store'])
->name('comments.store')
->middleware('auth');
Route::post('replies/{comment}', [ReplyController::class, 'store'])
->name('replies.store')
->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
