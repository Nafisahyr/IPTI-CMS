<?php

use Illuminate\Support\Facades\Route;

// ============ FORCE REGISTER MIDDLEWARE ============
if (!app()->runningInConsole()) {
    $router = app('router');

    // Cek apakah middleware sudah terdaftar
    if (!isset($router->getMiddleware()['role_or_permission'])) {
        // Registrasi langsung
        $router->aliasMiddleware('role_or_permission', \App\Http\Middleware\CheckRoleOrPermission::class);

        // Log untuk debugging
        \Log::info('Middleware role_or_permission force registered in routes file');
    }
}
// ===================================================

use App\Http\Controllers\{
    ProgramController,
    ProgramDetailController,
    FacilityController,
    EventController,
    BannerController,
    TuitionFeeController,
    DashboardController,
    EventNewController,
    AuthController
};

/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', fn () => view('auth.login'))->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'registerUser']);
});

Route::middleware('auth')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

/*
|--------------------------------------------------------------------------
| DEFAULT
|--------------------------------------------------------------------------
*/
Route::get('/', fn () => redirect()->route('dashboard'));


/*
|--------------------------------------------------------------------------
| PROGRAM ROUTES - Untuk admin & lecturer
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    // VIEW routes
    Route::middleware(['role_or_permission:admin,show-program'])->group(function () {
        Route::get('/programs', [ProgramController::class, 'index'])
            ->name('programs.index');
        Route::get('/programs/{program}', [ProgramController::class, 'show'])
            ->name('programs.show');
    });

    // CREATE routes
    Route::middleware(['role_or_permission:admin,add-program'])->group(function () {
        Route::get('/programs/create', [ProgramController::class, 'create'])
            ->name('programs.create');
        Route::post('/programs', [ProgramController::class, 'store'])
            ->name('programs.store');
    });

    // UPDATE routes
    Route::middleware(['role_or_permission:admin,update-program'])->group(function () {
        Route::get('/programs/{program}/edit', [ProgramController::class, 'edit'])
            ->name('programs.edit');
        Route::put('/programs/{program}', [ProgramController::class, 'update'])
            ->name('programs.update');
    });

    // DELETE route
    Route::middleware(['role_or_permission:admin,delete-program'])
        ->delete('/programs/{program}', [ProgramController::class, 'destroy'])
        ->name('programs.destroy');
});


/*
|--------------------------------------------------------------------------
| PROGRAM DETAIL ROUTES - Untuk admin & lecturer
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    // VIEW routes
    Route::middleware(['role_or_permission:admin,show-programDetail'])
        ->get('/programdetail/{id}', [ProgramDetailController::class, 'show'])
        ->name('programdetail.show');

    // CREATE routes
    Route::middleware(['role_or_permission:admin,add-programDetail'])
        ->get('/programdetail/create/{program}', [ProgramDetailController::class, 'create'])
        ->name('programdetail.create');

    Route::middleware(['role_or_permission:admin,add-programDetail'])
        ->post('/programdetail/store', [ProgramDetailController::class, 'store'])
        ->name('programdetail.store');

    // UPDATE routes
    Route::middleware(['role_or_permission:admin,update-programDetail'])
        ->get('/programdetail/{id}/edit', [ProgramDetailController::class, 'edit'])
        ->name('programdetail.edit');

    Route::middleware(['role_or_permission:admin,update-programDetail'])
        ->put('/programdetail/{id}', [ProgramDetailController::class, 'update'])
        ->name('programdetail.update');

    // DELETE route
    Route::middleware(['role_or_permission:admin,delete-programDetail'])
        ->delete('/programdetail/{id}', [ProgramDetailController::class, 'destroy'])
        ->name('programdetail.destroy');
});


/*
|--------------------------------------------------------------------------
| FACILITY ROUTES - Untuk admin & semua role (READ ONLY untuk non-admin)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    // VIEW routes (semua role bisa lihat)
    Route::middleware(['role_or_permission:admin,show-facility'])->group(function () {
        Route::get('/facilities', [FacilityController::class, 'index'])
            ->name('facilities.index');
        Route::get('/facilities/{facility}', [FacilityController::class, 'show'])
            ->name('facilities.show');
    });

    // CREATE routes (hanya admin)
    Route::middleware(['role_or_permission:admin,add-facility'])->group(function () {
        Route::get('/facilities/create', [FacilityController::class, 'create'])
            ->name('facilities.create');
        Route::post('/facilities', [FacilityController::class, 'store'])
            ->name('facilities.store');
    });

    // UPDATE routes (hanya admin)
    Route::middleware(['role_or_permission:admin,update-facility'])->group(function () {
        Route::get('/facilities/{facility}/edit', [FacilityController::class, 'edit'])
            ->name('facilities.edit');
        Route::put('/facilities/{facility}', [FacilityController::class, 'update'])
            ->name('facilities.update');
    });

    // DELETE route (hanya admin)
    Route::middleware(['role_or_permission:admin,delete-facility'])
        ->delete('/facilities/{facility}', [FacilityController::class, 'destroy'])
        ->name('facilities.destroy');
});


/*
|--------------------------------------------------------------------------
| BANNER ROUTES - Untuk admin & marketing
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    // VIEW routes
    Route::middleware(['role_or_permission:admin,show-banner'])->group(function () {
        Route::get('/banners', [BannerController::class, 'index'])
            ->name('banners.index');
        Route::get('/banners/{banner}', [BannerController::class, 'show'])
            ->name('banners.show');
    });

    // CREATE routes
    Route::middleware(['role_or_permission:admin,add-banner'])->group(function () {
        Route::get('/banners/create', [BannerController::class, 'create'])
            ->name('banners.create');
        Route::post('/banners', [BannerController::class, 'store'])
            ->name('banners.store');
    });

    // UPDATE routes
    Route::middleware(['role_or_permission:admin,update-banner'])->group(function () {
        Route::get('/banners/{banner}/edit', [BannerController::class, 'edit'])
            ->name('banners.edit');
        Route::put('/banners/{banner}', [BannerController::class, 'update'])
            ->name('banners.update');
    });

    // DELETE route
    Route::middleware(['role_or_permission:admin,delete-banner'])
        ->delete('/banners/{banner}', [BannerController::class, 'destroy'])
        ->name('banners.destroy');
});


/*
|--------------------------------------------------------------------------
| TUITION FEE ROUTES (ADMISSION) - Untuk admin, marketing & finance
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    // VIEW routes
    Route::middleware(['role_or_permission:admin,show-admission'])->group(function () {
        Route::get('/tuitionFees', [TuitionFeeController::class, 'index'])
            ->name('tuitionFees.index');
        Route::get('/tuitionFees/{tuitionFee}', [TuitionFeeController::class, 'show'])
            ->name('tuitionFees.show');
    });

    // CREATE routes
    Route::middleware(['role_or_permission:admin,add-admission'])->group(function () {
        Route::get('/tuitionFees/create', [TuitionFeeController::class, 'create'])
            ->name('tuitionFees.create');
        Route::post('/tuitionFees', [TuitionFeeController::class, 'store'])
            ->name('tuitionFees.store');
    });

    // UPDATE routes
    Route::middleware(['role_or_permission:admin,update-admission'])->group(function () {
        Route::get('/tuitionFees/{tuitionFee}/edit', [TuitionFeeController::class, 'edit'])
            ->name('tuitionFees.edit');
        Route::put('/tuitionFees/{tuitionFee}', [TuitionFeeController::class, 'update'])
            ->name('tuitionFees.update');
    });

    // DELETE route
    Route::middleware(['role_or_permission:admin,delete-admission'])
        ->delete('/tuitionFees/{tuitionFee}', [TuitionFeeController::class, 'destroy'])
        ->name('tuitionFees.destroy');
});


/*
|--------------------------------------------------------------------------
| EVENTS ROUTES - Untuk admin & public_relations
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    // VIEW routes
    Route::middleware(['role_or_permission:admin,show-event'])->group(function () {
        Route::get('/events', [EventController::class, 'index'])
            ->name('events.index');
        Route::get('/events/{event}', [EventController::class, 'show'])
            ->name('events.show');
    });

    // CREATE routes
    Route::middleware(['role_or_permission:admin,add-event'])->group(function () {
        Route::get('/events/create', [EventController::class, 'create'])
            ->name('events.create');
        Route::post('/events', [EventController::class, 'store'])
            ->name('events.store');
    });

    // UPDATE routes
    Route::middleware(['role_or_permission:admin,update-event'])->group(function () {
        Route::get('/events/{event}/edit', [EventController::class, 'edit'])
            ->name('events.edit');
        Route::put('/events/{event}', [EventController::class, 'update'])
            ->name('events.update');
    });

    // DELETE route
    Route::middleware(['role_or_permission:admin,delete-event'])
        ->delete('/events/{event}', [EventController::class, 'destroy'])
        ->name('events.destroy');
});


/*
|--------------------------------------------------------------------------
| EVENT NEWS ROUTES - Untuk admin & public_relations
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    // VIEW routes
    Route::middleware(['role_or_permission:admin,show-eventNews'])->group(function () {
        Route::get('/eventnews', [EventNewController::class, 'index'])
            ->name('eventNews.index');
        Route::get('/events/{eventId}/news', [EventNewController::class, 'show'])
            ->name('eventNews.show');
    });

    // CREATE routes
    Route::middleware(['role_or_permission:admin,add-eventNews'])->group(function () {
        Route::get('/events/{eventId}/news/create', [EventNewController::class, 'create'])
            ->name('eventNews.create');
        Route::post('/events/{eventId}/news', [EventNewController::class, 'store'])
            ->name('eventNews.store');
        Route::post('/events/{eventId}/news/multiple', [EventNewController::class, 'storeMultiple'])
            ->name('eventNews.storeMultiple');
    });

    // UPDATE routes
    Route::middleware(['role_or_permission:admin,update-eventNews'])->group(function () {
        Route::get('/eventnews/{id}/edit', [EventNewController::class, 'edit'])
            ->name('eventNews.edit');
        Route::put('/eventnews/{id}', [EventNewController::class, 'update'])
            ->name('eventNews.update');
    });

    // DELETE routes
    Route::middleware(['role_or_permission:admin,delete-eventNews'])->group(function () {
        Route::delete('/eventnews/{id}', [EventNewController::class, 'destroy'])
            ->name('eventNews.destroy');
        Route::delete('/eventnews', [EventNewController::class, 'destroyAll'])
            ->name('eventNews.destroyAll');
        Route::delete('/events/{eventId}/news', [EventNewController::class, 'destroyAllByEvent'])
            ->name('eventNews.destroyAllByEvent');
    });
});
