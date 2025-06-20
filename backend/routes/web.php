<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccueilController;
use App\Http\Controllers\AccueilPaysController;
use App\Http\Controllers\PrestationController;
use App\Http\Controllers\RecrutementController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\PosteController;
use App\Http\Controllers\UtilisateurController;
use App\Http\Controllers\EntrepriseController;
use App\Models\Entreprise;
use App\Http\Controllers\ChiffresController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [AccueilController::class, 'index'])->name('accueil');
Route::get('/benin', [AccueilPaysController::class, 'benin'])->name('accueil.benin');
Route::get('/togo', [AccueilPaysController::class, 'togo'])->name('accueil.togo');
Route::get('/niger', [AccueilPaysController::class, 'niger'])->name('accueil.niger');
Route::get('/prestation', [PrestationController::class, 'index'])->name('prestation');
Route::get('/contact', fn() => view('contact'))->name('contact');
Route::get('/blog', [BlogController::class, 'index'])->name('blog');
Route::get('/recrutement', [RecrutementController::class, 'index'])->name('recrutement');
Route::get('/recrutement/{id}', [RecrutementController::class, 'formulaire'])->name('recrutement.formulaire');
Route::get('/admin/login', [AdminController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.post');
Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');

Route::middleware(['web'])->group(function () {
    Route::get('/admin/blog/create', [BlogController::class, 'create'])->name('admin.blog.create');
    Route::post('/admin/blog', [BlogController::class, 'store'])->name('admin.blog.store');
    Route::get('/admin/blog/{id}/edit', [BlogController::class, 'edit'])->name('admin.blog.edit');
    Route::put('/admin/blog/{id}', [BlogController::class, 'update'])->name('admin.blog.update');
    Route::delete('/admin/blog/{id}', [BlogController::class, 'destroy'])->name('admin.blog.destroy');
    Route::get('/admin/newsletter/create', [NewsletterController::class, 'create'])->name('admin.newsletter.create');
    Route::post('/admin/newsletter', [NewsletterController::class, 'store'])->name('admin.newsletter.store');
    Route::get('/admin/newsletter/{mail}/edit', [NewsletterController::class, 'edit'])->name('admin.newsletter.edit');
    Route::put('/admin/newsletter/{mail}', [NewsletterController::class, 'update'])->name('admin.newsletter.update');
    Route::delete('/admin/newsletter/{mail}', [NewsletterController::class, 'destroy'])->name('admin.newsletter.destroy');
    Route::get('/admin/poste/create', [PosteController::class, 'create'])->name('admin.poste.create');
    Route::post('/admin/poste', [PosteController::class, 'store'])->name('admin.poste.store');
    Route::get('/admin/poste/{id}/edit', [PosteController::class, 'edit'])->name('admin.poste.edit');
    Route::put('/admin/poste/{id}', [PosteController::class, 'update'])->name('admin.poste.update');
    Route::delete('/admin/poste/{id}', [PosteController::class, 'destroy'])->name('admin.poste.destroy');
    Route::post('/admin/utilisateur', [UtilisateurController::class, 'store'])->name('admin.utilisateur.store');
    Route::delete('/admin/utilisateur/{mail}', [UtilisateurController::class, 'destroy'])->name('admin.utilisateur.destroy');
    Route::patch('/admin/utilisateur/{mail}/role', [UtilisateurController::class, 'updateRole'])->name('admin.utilisateur.updateRole');
    Route::get('/admin/entreprise/create', [EntrepriseController::class, 'create'])->name('admin.entreprise.create');
    Route::post('/admin/entreprise', [EntrepriseController::class, 'store'])->name('admin.entreprise.store');
    Route::get('/admin/entreprise/{id}/edit', [EntrepriseController::class, 'edit'])->name('admin.entreprise.edit');
    Route::put('/admin/entreprise/{id}', [EntrepriseController::class, 'update'])->name('admin.entreprise.update');
    Route::delete('/admin/entreprise/{id}', [EntrepriseController::class, 'destroy'])->name('admin.entreprise.destroy');
    Route::get('/admin/chiffres', [ChiffresController::class, 'edit'])->name('admin.chiffres.edit');
    Route::post('/admin/chiffres', [ChiffresController::class, 'update'])->name('admin.chiffres.update');
});

Route::get('/api/entreprises', function (\Illuminate\Http\Request $request) {
    if ($request->has('togo')) {
        return Entreprise::where('pays', 'togo')->get();
    }
    if ($request->has('benin')) {
        return Entreprise::where('pays', 'benin')->get();
    }
    if ($request->has('niger')) {
        return Entreprise::where('pays', 'niger')->get();
    }
    return Entreprise::all();
});
