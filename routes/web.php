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
    CurriculumStructureController,
    UserController,
    ActivityLogController
};
/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', fn () => view('auth.login'))->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    // Register hanya untuk admin atau jika ingin publik
    Route::get('/register', fn () => view('auth.register'))
        ->name('register')
        ->middleware('role:admin'); // Hanya admin bisa akses halaman register

    Route::post('/register', [AuthController::class, 'registerUser'])
        ->middleware('role:admin'); // Hanya admin bisa register user baru
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});
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
/*
|--------------------------------------------------------------------------
| PROGRAM DETAIL ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    // VIEW routes - admin & semua role
    Route::middleware(['role_or_permission:admin|show-programDetail'])
        ->get('/programdetail/{programDetail}', [ProgramDetailController::class, 'show'])
        ->name('programdetail.show');

    // CREATE routes - admin & lecturer
    Route::middleware(['role_or_permission:admin|add-programDetail'])
        ->get('/programdetail/create/{program}', [ProgramDetailController::class, 'create'])
        ->name('programdetail.create');

    Route::middleware(['role_or_permission:admin|add-programDetail'])
        ->post('/programdetail', [ProgramDetailController::class, 'store'])
        ->name('programdetail.store');

    // UPDATE routes - admin & lecturer
    Route::middleware(['role_or_permission:admin|update-programDetail'])
        ->get('/programdetail/{programDetail}/edit', [ProgramDetailController::class, 'edit'])
        ->name('programdetail.edit');

    Route::middleware(['role_or_permission:admin|update-programDetail'])
        ->put('/programdetail/{programDetail}', [ProgramDetailController::class, 'update'])
        ->name('programdetail.update');

    // DELETE route - admin & lecturer
    Route::middleware(['role_or_permission:admin|delete-programDetail'])
        ->delete('/programdetail/{programDetail}', [ProgramDetailController::class, 'destroy'])
        ->name('programdetail.destroy');
});

/*
|--------------------------------------------------------------------------
| CURRICULUM STRUCTURE ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    // VIEW routes - admin & semua role yang memiliki permission show-curriculumStructure
    Route::middleware(['role_or_permission:admin|show-curriculumStructure'])->group(function () {
        // Menampilkan struktur kurikulum untuk program detail tertentu
        Route::get('/structure/program-detail/{programDetail}', [CurriculumStructureController::class, 'index'])
            ->name('structure.index');

        // Menampilkan detail struktur kurikulum tertentu
        Route::get('/structure/{structure}', [CurriculumStructureController::class, 'show'])
            ->name('structure.show');
    });

    // CREATE routes - admin & lecturer
    Route::middleware(['role_or_permission:admin|add-curriculumStructure'])->group(function () {
        // Form create untuk single structure
        Route::get('/structure/program-detail/{programDetail}/create', [CurriculumStructureController::class, 'create'])
            ->name('structure.create');

        // Form create untuk multiple structures
        Route::get('/structure/program-detail/{programDetail}/create-multiple', [CurriculumStructureController::class, 'createMultiple'])
            ->name('structure.create.multiple');

        // Store single structure
        Route::post('/structure', [CurriculumStructureController::class, 'store'])
            ->name('structure.store');

        // Store multiple structures
        Route::post('/structure/program-detail/{programDetail}/store-multiple', [CurriculumStructureController::class, 'storeMultiple'])
            ->name('structure.store.multiple');

        // Store all structures (batch)
        Route::post('/structure/program-detail/{programDetail}/store-all', [CurriculumStructureController::class, 'storeAll'])
            ->name('structure.store.all');
    });

    // UPDATE routes - admin & lecturer
    Route::middleware(['role_or_permission:admin|update-curriculumStructure'])->group(function () {
        // Form edit
        Route::get('/structure/{structure}/edit', [CurriculumStructureController::class, 'edit'])
            ->name('structure.edit');

        // Update single structure
        Route::put('/structure/{structure}', [CurriculumStructureController::class, 'update'])
            ->name('structure.update');

        // Update multiple structures
        Route::put('/structure/program-detail/{programDetail}/update-multiple', [CurriculumStructureController::class, 'updateMultiple'])
            ->name('structure.update.multiple');
    });

    // DELETE routes - admin & lecturer
    Route::middleware(['role_or_permission:admin|delete-curriculumStructure'])->group(function () {
        // Delete single structure
        Route::delete('/structure/{structure}', [CurriculumStructureController::class, 'destroy'])
            ->name('structure.destroy');

        // Delete all structures for a program detail
        Route::delete('/structure/program-detail/{programDetail}/destroy-all', [CurriculumStructureController::class, 'destroyAll'])
            ->name('structure.destroy.all');
    });
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

// Profile routes
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/profile', [UserController::class, 'update'])->name('users.update');
    Route::post('/profile/avatar', [UserController::class, 'updateAvatar'])->name('profile.avatar.update');
    Route::delete('/profile/avatar', [UserController::class, 'removeAvatar'])->name('profile.avatar.remove');
});
/*
|--------------------------------------------------------------------------
| ACTIVITY LOG ROUTES (Admin Only)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/activities', [ActivityLogController::class, 'index'])
        ->name('activities.index');

    Route::get('/activities/{activity}', [ActivityLogController::class, 'show'])
        ->name('activities.show');

    Route::delete('/activities/{activity}', [ActivityLogController::class, 'destroy'])
        ->name('activities.destroy');

    Route::delete('/activities', [ActivityLogController::class, 'clearAll'])
        ->name('activities.clearAll');

    Route::get('/users/{user}/activities', [ActivityLogController::class, 'userActivities'])
        ->name('activities.user');
});
/*
|--------------------------------------------------------------------------
| USER MANAGEMENT ROUTES (Admin Only)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->group(function () {
    // Users index
    Route::get('/users', [UserController::class, 'index'])
        ->name('users.index');

    // Create user
    Route::get('/users/create', [UserController::class, 'create'])
        ->name('users.create');
    Route::post('/users', [UserController::class, 'store'])
        ->name('users.store');

    // Show user
    Route::get('/users/{user}', [UserController::class, 'show'])
        ->name('users.show');

    // Edit user (admin)
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])
        ->name('users.edit.admin');
    Route::put('/users/{user}', [UserController::class, 'updateByAdmin'])
        ->name('users.update.admin');

    // Delete user
    Route::delete('/users/{user}', [UserController::class, 'destroy'])
        ->name('users.destroy');
});
