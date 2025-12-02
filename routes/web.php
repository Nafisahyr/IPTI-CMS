<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    ProgramController,
    ProgramDetailController,
    CurriculumStructureController,
    FacilityController,
    EventController,
    BannerController,
    AdmissionController,
    DashboardController,
    EventNewController
};
use App\Models\EventNew;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::prefix('api')->group(function () {
    Route::get('/programs', [ProgramController::class, 'apiIndex']);
    Route::get('/facilities', [FacilityController::class, 'apiIndex']);
    Route::get('/admissions', [AdmissionController::class, 'apiIndex']);
});

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('layout');
});

/*
|--------------------------------------------------------------------------
| Program Routes
|--------------------------------------------------------------------------
*/
Route::get('/programs', [ProgramController::class, 'create'])->name('programs.index');
Route::post('/programs', [ProgramController::class, 'store'])->name('programs.store');
Route::resource('programs', ProgramController::class);

Route::get('/facilities', [FacilityController::class, 'create'])->name('facilities.index');
Route::post('/facilities', [FacilityController::class, 'store'])->name('facilities.store');
Route::resource('facilities', FacilityController::class);

Route::get('/events', [EventController::class, 'create'])->name('events.index');
Route::post('/events', [EventController::class, 'store'])->name('events.store');
Route::resource('events', EventController::class);

Route::get('/banners', [BannerController::class, 'create'])->name('banners.index');
Route::post('/banners', [BannerController::class, 'store'])->name('banners.store');
Route::resource('banners', BannerController::class);

Route::get('/admissions', [AdmissionController::class, 'create'])->name('admissions.index');
Route::post('/admissions', [AdmissionController::class, 'store'])->name('admissions.store');
Route::resource('admissions', AdmissionController::class);

/*
|--------------------------------------------------------------------------
| Program Detail (Step 1)
|--------------------------------------------------------------------------
| Tahap pertama dari proses input detail program.
| Setelah tersimpan, diarahkan ke tahapan struktur kurikulum.
*/
Route::prefix('programdetail')->group(function () {

    // form create detail berdasarkan program id
    Route::get('/create/{program}', [ProgramDetailController::class, 'create'])
        ->name('programdetail.create');

    // simpan detail program
    Route::post('/store', [ProgramDetailController::class, 'store'])
        ->name('programdetail.store');

    // edit detail
    Route::get('/{programDetail}/edit', [ProgramDetailController::class, 'edit'])
        ->name('programdetail.edit');

    // update detail
    Route::put('/{programDetail}', [ProgramDetailController::class, 'update'])
        ->name('programdetail.update');

    // tampilkan detail program
    Route::get('/{programDetail}', [ProgramDetailController::class, 'show'])
        ->name('programdetail.show');
});

/*
|--------------------------------------------------------------------------
| Curriculum Structure (Step 2)
|--------------------------------------------------------------------------
| Tahap kedua setelah program detail selesai.
| Memiliki foreign key ke program_detail_id.
| Minimal input 3 struktur sebelum redirect ke tampilan detail.
*/
Route::prefix('structure')->group(function () {

    // Form create
    Route::get(
        '/program-detail/{id}/create',
        [CurriculumStructureController::class, 'create']
    )
        ->name('structure.create');

    // Simpan satu-satu (opsional)
    Route::post(
        '/store/{programDetail}',
        [CurriculumStructureController::class, 'store']
    )
        ->name('structure.store');

    // Save multiple
    Route::post(
        '/program-detail/{programDetailId}/store-all',
        [CurriculumStructureController::class, 'storeAll']
    )
        ->name('structure.store.all');

    Route::get('/program-detail/{id}', [ProgramDetailController::class, 'show'])
        ->name('programdetail.show');

    Route::get('/program-detail/{id}/edit', [ProgramDetailController::class, 'edit'])
        ->name('programdetail.edit');

    Route::put('/program-detail/{id}', [ProgramDetailController::class, 'update'])
        ->name('programdetail.update');

    Route::post('/program-detail/{id}/structure/store-all', [CurriculumStructureController::class, 'storeAll'])
        ->name('curriculum-structure.storeAll');


    Route::delete('/{programDetail}', [ProgramDetailController::class, 'destroy'])
        ->name('programdetail.destroy');
});

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');


Route::prefix('eventnew')->group(function () {
    Route::get('/eventnews', [EventNewController::class, 'index'])->name('eventNews.index');
    Route::get('/events/{eventId}/news/create', [EventNewController::class, 'create'])->name('eventNews.create');
    Route::post('/events/{eventId}/news', [EventNewController::class, 'store'])->name('eventNews.store');

    // PERBAIKI INI: Gunakan 'eventNews.show' bukan 'eventNews.index'
    Route::get('/events/{eventId}/news', [EventNewController::class, 'show'])->name('eventNews.show');

    Route::get('/eventnews/{eventNewId}/edit', [EventNewController::class, 'edit'])->name('eventNews.edit');
    Route::put('/eventnews/{eventNewId}', [EventNewController::class, 'update'])->name('eventNews.update');
    Route::delete('/eventnews/{eventNewId}', [EventNewController::class, 'destroy'])->name('eventNews.destroy');
    Route::delete('/eventnews', [EventNewController::class, 'destroyAll'])->name('eventNews.destroyAll');
    Route::delete('/events/{eventId}/news', [EventNewController::class, 'destroyAllByEvent'])->name('eventNews.destroyAllByEvent');
    Route::post('/events/{eventId}/news/multiple', [EventNewController::class, 'storeMultiple'])->name('eventNews.storeMultiple');
});
