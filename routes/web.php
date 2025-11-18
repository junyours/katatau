<?php

use App\Http\Controllers\Admin\ArchiveController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EditorialBoard;
use App\Http\Controllers\Admin\JournalController;
use App\Http\Controllers\WebController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
  Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

  Route::get('/admin/editorial-board', [EditorialBoard::class, 'index'])->name('admin.editorial-board');
  Route::get('/admin/editorial-board/create', [EditorialBoard::class, 'create'])->name('admin.editorial-board.create');
  Route::post('/admin/editorial-board/add', [EditorialBoard::class, 'add'])->name('admin.editorial-board.add');
  Route::get('/admin/editorial-board/edit/{id}', [EditorialBoard::class, 'edit'])->name('admin.editorial-board.edit');
  Route::post('/admin/editorial-board/update/{id}', [EditorialBoard::class, 'update'])->name('admin.editorial-board.update');

  Route::get('/admin/archive', [ArchiveController::class, 'index'])->name('admin.archive');
  Route::get('/admin/archive/create', [ArchiveController::class, 'create'])->name('admin.archive.create');
  Route::post('/admin/archive/add', [ArchiveController::class, 'add'])->name('admin.archive.add');
  Route::get('/admin/archive/edit/{id}', [ArchiveController::class, 'edit'])->name('admin.archive.edit');
  Route::post('/admin/archive/update/{id}', [ArchiveController::class, 'update'])->name('admin.archive.update');

  Route::get('/admin/archive/volume-{volume}/issue-{issue}/{from_month}/{to_month}', [JournalController::class, 'index'])->name('admin.journal');
  Route::get('/admin/journal/create/{folder_id}', [JournalController::class, 'create'])->name('admin.journal.create');
  Route::post('/admin/journal/add/{id}', [JournalController::class, 'add'])->name('admin.journal.add');
  Route::get('/admin/journal/edit/{id}', [JournalController::class, 'edit'])->name('admin.journal.edit');
  Route::post('/admin/journal/update/{id}', [JournalController::class, 'update'])->name('admin.journal.update');
});

Route::get('/', [WebController::class, 'home'])->name('home');
Route::get('/editorial-board', [WebController::class, 'editorialBoard'])->name('editorial-board');
Route::get('/contact-us', [WebController::class, 'contactUs'])->name('contact-us');

Route::get('/about-journal', [WebController::class, 'aboutJournal'])->name('about-journal');
Route::get('/about-publisher', [WebController::class, 'aboutPublisher'])->name('about-publisher');
Route::get('/indexing', [WebController::class, 'indexing'])->name('indexing');
Route::get('/current-issue', [WebController::class, 'currentIssue'])->name('current-issue');
Route::get('/past-issue', [WebController::class, 'pastIssue'])->name('past-issue');

Route::get('/submission-guidelines', [WebController::class, 'submissionGuideline'])->name('submission-guideline');
Route::get('/research-ethics', [WebController::class, 'researchEthics'])->name('research-ethics');

Route::get('/archive/volume-{volume}/issue-{issue}/{from_month}/{to_month}', [WebController::class, 'index'])->name('archive');
Route::get('/archive/volume-{volume}/issue-{issue}/{from_month}/{to_month}/{hashedId}', [WebController::class, 'pdf'])->name('archive.pdf');
Route::get('/abstract/{title}', [WebController::class, 'abstract'])->name('abstract');

require __DIR__ . '/auth.php';