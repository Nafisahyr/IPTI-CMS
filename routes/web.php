<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    ProgramController,
    ProgramDetailController,
    FacilityController,
    EventController,
    BannerController,
    TuitionFeeController,
    DashboardController,
    EventNewController,
    AuthController,
    UserController
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
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
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
| PROGRAM ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    // VIEW routes - admin & lecturer & semua role (karena semua ada show-program)
    Route::middleware(['role_or_permission:admin|show-program'])->group(function () {
        Route::get('/programs', [ProgramController::class, 'index'])
            ->name('programs.index');
        Route::get('/programs/{program}', [ProgramController::class, 'show'])
            ->name('programs.show');
    });

    // CREATE routes - admin & lecturer
    Route::middleware(['role_or_permission:admin|add-program'])->group(function () {
        Route::get('/programs/create', [ProgramController::class, 'create'])
            ->name('programs.create');
        Route::post('/programs', [ProgramController::class, 'store'])
            ->name('programs.store');
    });

    // UPDATE routes - admin & lecturer
    Route::middleware(['role_or_permission:admin|update-program'])->group(function () {
        Route::get('/programs/{program}/edit', [ProgramController::class, 'edit'])
            ->name('programs.edit');
        Route::put('/programs/{program}', [ProgramController::class, 'update'])
            ->name('programs.update');
    });

    // DELETE route - admin & lecturer
    Route::middleware(['role_or_permission:admin|delete-program'])
        ->delete('/programs/{program}', [ProgramController::class, 'destroy'])
        ->name('programs.destroy');
});

/*
|--------------------------------------------------------------------------
| PROGRAM DETAIL ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    // VIEW routes - admin & semua role
    Route::middleware(['role_or_permission:admin|show-programDetail'])
        ->get('/programdetail/{id}', [ProgramDetailController::class, 'show'])
        ->name('programdetail.show');

    // CREATE routes - admin & lecturer
    Route::middleware(['role_or_permission:admin|add-programDetail'])
        ->get('/programdetail/create/{program}', [ProgramDetailController::class, 'create'])
        ->name('programdetail.create');

    Route::middleware(['role_or_permission:admin|add-programDetail'])
        ->post('/programdetail/store', [ProgramDetailController::class, 'store'])
        ->name('programdetail.store');

    // UPDATE routes - admin & lecturer
    Route::middleware(['role_or_permission:admin|update-programDetail'])
        ->get('/programdetail/{id}/edit', [ProgramDetailController::class, 'edit'])
        ->name('programdetail.edit');

    Route::middleware(['role_or_permission:admin|update-programDetail'])
        ->put('/programdetail/{id}', [ProgramDetailController::class, 'update'])
        ->name('programdetail.update');

    // DELETE route - admin & lecturer
    Route::middleware(['role_or_permission:admin|delete-programDetail'])
        ->delete('/programdetail/{id}', [ProgramDetailController::class, 'destroy'])
        ->name('programdetail.destroy');
});

/*
|--------------------------------------------------------------------------
| FACILITY ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    // VIEW routes - admin & semua role
    Route::middleware(['role_or_permission:admin|show-facility'])->group(function () {
        Route::get('/facilities', [FacilityController::class, 'index'])
            ->name('facilities.index');
        Route::get('/facilities/{facility}', [FacilityController::class, 'show'])
            ->name('facilities.show');
    });

    // CREATE routes - admin saja
    Route::middleware(['role_or_permission:admin|add-facility'])->group(function () {
        Route::get('/facilities/create', [FacilityController::class, 'create'])
            ->name('facilities.create');
        Route::post('/facilities', [FacilityController::class, 'store'])
            ->name('facilities.store');
    });

    // UPDATE routes - admin saja
    Route::middleware(['role_or_permission:admin|update-facility'])->group(function () {
        Route::get('/facilities/{facility}/edit', [FacilityController::class, 'edit'])
            ->name('facilities.edit');
        Route::put('/facilities/{facility}', [FacilityController::class, 'update'])
            ->name('facilities.update');
    });

    // DELETE route - admin saja
    Route::middleware(['role_or_permission:admin|delete-facility'])
        ->delete('/facilities/{facility}', [FacilityController::class, 'destroy'])
        ->name('facilities.destroy');
});

/*
|--------------------------------------------------------------------------
| BANNER ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    // VIEW routes - admin & semua role
    Route::middleware(['role_or_permission:admin|show-banner'])->group(function () {
        Route::get('/banners', [BannerController::class, 'index'])
            ->name('banners.index');
        Route::get('/banners/{banner}', [BannerController::class, 'show'])
            ->name('banners.show');
    });

    // CREATE routes - admin & marketing
    Route::middleware(['role_or_permission:admin|add-banner'])->group(function () {
        Route::get('/banners/create', [BannerController::class, 'create'])
            ->name('banners.create');
        Route::post('/banners', [BannerController::class, 'store'])
            ->name('banners.store');
    });

    // UPDATE routes - admin & marketing
    Route::middleware(['role_or_permission:admin|update-banner'])->group(function () {
        Route::get('/banners/{banner}/edit', [BannerController::class, 'edit'])
            ->name('banners.edit');
        Route::put('/banners/{banner}', [BannerController::class, 'update'])
            ->name('banners.update');
    });

    // DELETE route - admin & marketing
    Route::middleware(['role_or_permission:admin|delete-banner'])
        ->delete('/banners/{banner}', [BannerController::class, 'destroy'])
        ->name('banners.destroy');
});

/*
|--------------------------------------------------------------------------
| TUITION FEE (ADMISSION) ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    // VIEW routes - admin & semua role
    Route::middleware(['role_or_permission:admin|show-admission'])->group(function () {
        Route::get('/tuitionFees', [TuitionFeeController::class, 'index'])
            ->name('tuitionFees.index');
        Route::get('/tuitionFees/{tuitionFee}', [TuitionFeeController::class, 'show'])
            ->name('tuitionFees.show');
    });

    // CREATE routes - admin & marketing & finance
    Route::middleware(['role_or_permission:admin|add-admission'])->group(function () {
        Route::get('/tuitionFees/create', [TuitionFeeController::class, 'create'])
            ->name('tuitionFees.create');
        Route::post('/tuitionFees', [TuitionFeeController::class, 'store'])
            ->name('tuitionFees.store');
    });

    // UPDATE routes - admin & marketing & finance
    Route::middleware(['role_or_permission:admin|update-admission'])->group(function () {
        Route::get('/tuitionFees/{tuitionFee}/edit', [TuitionFeeController::class, 'edit'])
            ->name('tuitionFees.edit');
        Route::put('/tuitionFees/{tuitionFee}', [TuitionFeeController::class, 'update'])
            ->name('tuitionFees.update');
    });

    // DELETE route - admin & marketing & finance
    Route::middleware(['role_or_permission:admin|delete-admission'])
        ->delete('/tuitionFees/{tuitionFee}', [TuitionFeeController::class, 'destroy'])
        ->name('tuitionFees.destroy');
});

/*
|--------------------------------------------------------------------------
| EVENT ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    // VIEW routes - admin & semua role
    Route::middleware(['role_or_permission:admin|show-event'])->group(function () {
        Route::get('/events', [EventController::class, 'index'])
            ->name('events.index');
        Route::get('/events/{event}', [EventController::class, 'show'])
            ->name('events.show');
    });

    // CREATE routes - admin & public_relations
    Route::middleware(['role_or_permission:admin|add-event'])->group(function () {
        Route::get('/events/create', [EventController::class, 'create'])
            ->name('events.create');
        Route::post('/events', [EventController::class, 'store'])
            ->name('events.store');
    });

    // UPDATE routes - admin & public_relations
    Route::middleware(['role_or_permission:admin|update-event'])->group(function () {
        Route::get('/events/{event}/edit', [EventController::class, 'edit'])
            ->name('events.edit');
        Route::put('/events/{event}', [EventController::class, 'update'])
            ->name('events.update');
    });

    // DELETE route - admin & public_relations
    Route::middleware(['role_or_permission:admin|delete-event'])
        ->delete('/events/{event}', [EventController::class, 'destroy'])
        ->name('events.destroy');
});

/*
|--------------------------------------------------------------------------
| EVENT NEWS ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    // VIEW routes - admin & semua role
    Route::middleware(['role_or_permission:admin|show-eventNews'])->group(function () {
        Route::get('/eventnews', [EventNewController::class, 'index'])
            ->name('eventNews.index');
        Route::get('/events/{eventId}/news', [EventNewController::class, 'show'])
            ->name('eventNews.show');
    });

    // CREATE routes - admin & public_relations
    Route::middleware(['role_or_permission:admin|add-eventNews'])->group(function () {
        Route::get('/events/{eventId}/news/create', [EventNewController::class, 'create'])
            ->name('eventNews.create');
        Route::post('/events/{eventId}/news', [EventNewController::class, 'store'])
            ->name('eventNews.store');
        Route::post('/events/{eventId}/news/multiple', [EventNewController::class, 'storeMultiple'])
            ->name('eventNews.storeMultiple');
    });

    // UPDATE routes - admin & public_relations
    Route::middleware(['role_or_permission:admin|update-eventNews'])->group(function () {
        Route::get('/eventnews/{id}/edit', [EventNewController::class, 'edit'])
            ->name('eventNews.edit');
        Route::put('/eventnews/{id}', [EventNewController::class, 'update'])
            ->name('eventNews.update');
    });

    // DELETE routes - admin & public_relations
    Route::middleware(['role_or_permission:admin|delete-eventNews'])->group(function () {
        Route::delete('/eventnews/{id}', [EventNewController::class, 'destroy'])
            ->name('eventNews.destroy');
        Route::delete('/eventnews', [EventNewController::class, 'destroyAll'])
            ->name('eventNews.destroyAll');
        Route::delete('/events/{eventId}/news', [EventNewController::class, 'destroyAllByEvent'])
            ->name('eventNews.destroyAllByEvent');
    });
});

/*
|--------------------------------------------------------------------------
| TEST ROUTES (Untuk Debugging)
|--------------------------------------------------------------------------
*/
Route::get('/test-permissions', function () {
    $user = auth()->user();

    if (!$user) {
        return 'Not logged in';
    }

    return response()->json([
        'user' => $user->only(['id', 'name', 'email']),
        'roles' => $user->getRoleNames(),
        'permissions' => $user->getAllPermissions()->pluck('name'),
        'can_view_program' => $user->can('show-program'),
        'can_add_program' => $user->can('add-program'),
    ]);
})->middleware(['auth']);

Route::get('/test-middleware', function () {
    return 'Middleware test successful!';
})->middleware(['auth', 'role_or_permission:admin|show-program']);

// Profile routes
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/profile', [UserController::class, 'update'])->name('users.update');
    Route::post('/profile/avatar', [UserController::class, 'updateAvatar'])->name('profile.avatar.update');
    Route::delete('/profile/avatar', [UserController::class, 'removeAvatar'])->name('profile.avatar.remove');
});
