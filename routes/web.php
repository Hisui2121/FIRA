    <?php

    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\Auth\RegisterController;
    use App\Http\Controllers\Auth\LoginController;
    use App\Http\Controllers\ProductController;
    use App\Http\Controllers\DashboardController;
    use App\Http\Controllers\Admin\AdminDashboardController;
    use App\Http\Controllers\Staff\StaffDashboardController;
    use App\Http\Controllers\SupplierController;
    use App\Http\Controllers\AuditLogController;
    use App\Http\Controllers\SettingsController;
    use App\Http\Controllers\ProfileController;
    use App\Http\Controllers\UserController;

    Route::middleware(['auth', 'role:admin'])->group(function () {

        Route::resource('users', UserController::class);
        Route::get('/users', [UserController::class, 'index'])
        ->name('users.index');

    });

    Route::middleware(['auth'])->group(function () {

        Route::get('/account', [ProfileController::class, 'edit'])
            ->name('profile.edit');

        Route::put('/account', [ProfileController::class, 'update'])
            ->name('profile.update');

        Route::put('/profile/photo', [ProfileController::class, 'updatePhoto'])
        ->name('profile.photo.update');

        Route::put('/profile/cover', [ProfileController::class, 'updateCover'])
        ->name('profile.cover.update');

    });

    Route::middleware(['auth'])->prefix('settings')->group(function () {

        Route::get('/', [SettingsController::class, 'index'])
            ->name('settings.index');

        Route::get('/appearance', [SettingsController::class, 'appearance'])
            ->name('settings.appearance');

        Route::put('/appearance', [SettingsController::class, 'updateAppearance'])
            ->name('settings.appearance.update');

        Route::get('/security', [SettingsController::class, 'security'])
            ->name('settings.security');

        Route::get('/preferences', [SettingsController::class, 'preferences'])
            ->name('settings.preferences');

        Route::get('/account', [SettingsController::class, 'account'])
            ->name('settings.account');

        Route::get('/system', [SettingsController::class, 'system'])
            ->name('settings.system');
    });

    Route::middleware(['auth'])->group(function () {

        // DASHBOARDS
        Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])
            ->name('admin.dashboard')
            ->middleware('role:admin');

        Route::get('/admin/audit-logs', [AdminDashboardController::class, 'logs'])
            ->name('admin.logs')
            ->middleware('role:admin');

        Route::get('/staff/dashboard', [StaffDashboardController::class, 'index'])
            ->name('staff.dashboard')
            ->middleware('role:staff');


        Route::get('/products', [ProductController::class, 'index'])
            ->name('products.index');

        Route::post('/stockin/{variant}', [ProductController::class, 'stockIn'])
            ->name('products.stockin');

        Route::post('/stockout/{id}', [ProductController::class, 'stockOut'])
            ->name('products.stockout');

        Route::resource('suppliers', SupplierController::class);

        Route::get('/profile', function () {
            return view('profile');
        })->middleware('auth')->name('profile');

        // ADMIN ONLY ACTIONS
        Route::middleware('role:admin')->group(function () {

            Route::get('/products/create', [ProductController::class, 'create'])
                ->name('products.create');

            Route::post('/products', [ProductController::class, 'store'])
                ->name('products.store');

            Route::get('/products/{product}/edit', [ProductController::class, 'edit'])
                ->name('products.edit');

            Route::put('/products/{product}', [ProductController::class, 'update'])
                ->name('products.update');

            Route::delete('/products/{product}', [ProductController::class, 'destroy'])
                ->name('products.destroy');

            Route::get('/audit-logs', [AuditLogController::class, 'index'])
            ->name('audit.logs');
        });

        Route::post('/logout', [LoginController::class, 'destroy'])
            ->name('logout');
    });
    // Home
    Route::get('/', function () {
        return view('welcome'); // Pinalitan natin ang '/login' ng 'welcome'
    });

    Route::middleware('guest')->group(function () {
        Route::get('/register', [RegisterController::class, 'create'])->name('register');
        Route::post('/register', [RegisterController::class, 'store']);
        Route::post('/register/back', [RegisterController::class, 'back'])->name('register.back');

        Route::get('/login', [LoginController::class, 'create'])->name('login');
        Route::post('/login', [LoginController::class, 'store']);

        Route::get('/forgot-password', function () {
        return view('auth.forgot-password');
    })->name('password.request');

    
    });

    // LEGAL PAGES
Route::prefix('legal')->group(function () {
    Route::get('/privacy', function () { return view('legal.privacy'); })->name('privacy');
    Route::get('/security', function () { return view('legal.security'); })->name('security');
    Route::get('/contact', function () { return view('legal.contact'); })->name('contact');
});



