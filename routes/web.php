<?php


use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PropertyController;
use Illuminate\Support\Facades\Route;
use App\Models\Property; 


// Route pour la page d'accueil
Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        $properties = Property::all(); // Récupère toutes les propriétés pour les afficher sur le tableau de bord
        return view('dashboard', compact('properties'));
    })->name('dashboard');

    // Routes de profil (générées par Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Routes pour les propriétés
    Route::get('/properties', [PropertyController::class, 'index'])->name('properties.index'); // Liste des propriétés
    Route::get('/properties/{property}', [PropertyController::class, 'show'])->name('properties.show'); // Détail d'une propriété
});

require __DIR__.'/auth.php';
