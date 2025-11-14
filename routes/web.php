    <?php

    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\{
        ProgramController,
        ProgramDetailController,
        CurriculumStructureController,
        FacilityController,
        EventController,
        BannerController,
        AdmissionController
    };

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
    Route::resource('programs', ProgramController::class);

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

        // edit & update data detail
        Route::get('/{programDetail}/edit', [ProgramDetailController::class, 'edit'])
            ->name('programdetail.edit');
        Route::put('/{programDetail}', [ProgramDetailController::class, 'update'])
            ->name('programdetail.update');

        // tampilkan detail program (optional)
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
        // form create structure berdasarkan program_detail_id
        Route::get('/{programDetail}/structure/create', [CurriculumStructureController::class, 'create'])   
            ->name('structure.create');

        // simpan data structure
        Route::post('/store/{programDetail}', [CurriculumStructureController::class, 'store'])
            ->name('structure.store');
    });
