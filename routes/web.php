<?php

use App\Http\Middleware\CheckAdmin;
use App\Http\Middleware\CheckAge;
use App\Http\Middleware\CheckAuth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Rutas Públicas (Acceso Libre)
|--------------------------------------------------------------------------
| /, /login y /register son accesibles por cualquier visitante sin autenticar.
*/

// Pantalla principal de bienvenida al resort
Route::get('/', function () {
    return view('home');
})->name('home');

// Formulario de inicio de sesión
Route::get('/login', function () {
    if (Auth::check()) {
        return redirect()->route('panel');
    }
    return view('login');
})->name('login');

// Procesa el inicio de sesión
Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->intended(route('panel'))->with('success', '¡Bienvenido al Grand Mirage, ' . Auth::user()->name . '!');
    }

    return back()->withErrors([
        'email' => 'Las credenciales no coinciden con los registros del resort.',
    ])->onlyInput('email');
});

// Selector rápido para pruebas de middlewares (acepta ID numérico o rol: admin, adulto, menor)
Route::get('/quick-login/{identifier}', function (string $identifier) {
    $user = null;

    if (is_numeric($identifier)) {
        $user = User::find((int) $identifier);
    }

    if (! $user) {
        $user = match (strtolower($identifier)) {
            'admin', '1' => User::where('is_admin', true)->first(),
            'menor', '3' => User::where('age', '<', 18)->where('is_admin', false)->first(),
            'adulto', 'adult', '2' => User::where('age', '>=', 18)->where('is_admin', false)->first(),
            default => null,
        };
    }

    if (! $user) {
        return redirect()->route('login')->with('error', 'Usuario de prueba no encontrado. Ejecuta php artisan db:seed.');
    }

    Auth::login($user);
    request()->session()->regenerate();

    $roleLabel = $user->is_admin ? 'Director (Admin)' : ($user->age >= 18 ? 'Huésped Adulto' : 'Huésped Menor');

    return redirect()->route('panel')->with('success', 'Sesión iniciada como ' . $user->name . ' (' . $roleLabel . ' - ' . $user->age . ' años)');
})->name('quick.login');

// Cierre de sesión seguro
Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('home')->with('success', 'Has entregado la llave de tu habitación.');
})->name('logout');

// Formulario de registro de cuentas
Route::get('/register', function () {
    if (Auth::check()) {
        return redirect()->route('panel');
    }
    return view('register');
})->name('register');

// Procesa el registro de nuevos huéspedes
Route::post('/register', function (Request $request) {
    $validated = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:6'],
        'age' => ['required', 'integer', 'min:1', 'max:120'],
    ]);

    $user = User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => $validated['password'],
        'age' => (int) $validated['age'],
        'is_admin' => false,
    ]);

    Auth::login($user);
    $request->session()->regenerate();

    return redirect()->route('panel')->with('success', '¡Registro completado! Tu llave de huésped ha sido activada.');
});


/*
|--------------------------------------------------------------------------
| Rutas Privadas (Requieren Protección de Middlewares)
|--------------------------------------------------------------------------
| Agrupadas según las especificaciones de seguridad.
*/

// 1. /panel: Protegida ÚNICAMENTE por el middleware de autenticación (CheckAuth)
Route::middleware([CheckAuth::class])->group(function () {
    Route::get('/panel', function () {
        return view('panel-usuario');
    })->name('panel');
});

// 2. /casino: Protegida por el middleware de autenticación (CheckAuth) Y por el de edad (CheckAge)
Route::middleware([CheckAuth::class, CheckAge::class])->group(function () {
    Route::get('/casino', function () {
        return view('casino');
    })->name('casino');
});

// 3. /admin: Protegida por el middleware de autenticación (CheckAuth) Y por el de administrador (CheckAdmin)
Route::middleware([CheckAuth::class, CheckAdmin::class])->group(function () {
    Route::get('/admin', function () {
        return view('panel-admin');
    })->name('admin');

    // Funciones interactivas de administración para pruebas en vivo
    Route::post('/admin/users/{user}/toggle-admin', function (User $user) {
        $user->is_admin = ! $user->is_admin;
        $user->save();

        return back()->with('success', 'Rol de ' . $user->name . ' actualizado a: ' . ($user->is_admin ? 'Administrador' : 'Huésped Estándar'));
    })->name('admin.users.toggle-admin');

    Route::post('/admin/users/{user}/set-age', function (Request $request, User $user) {
        $request->validate(['age' => 'required|integer|min:1|max:120']);
        $user->age = (int) $request->age;
        $user->save();

        return back()->with('success', 'Edad de ' . $user->name . ' actualizada a: ' . $user->age . ' años');
    })->name('admin.users.set-age');
});
