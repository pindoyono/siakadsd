<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\KlasController;
use App\Http\Controllers\RombelController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\PerencanaanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', function() {
    return view('home');
})->name('home')->middleware('auth');

Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('permissions', PermissionController::class);
    Route::resource('gurus', GuruController::class);
    Route::resource('siswas', SiswaController::class);
    Route::resource('kelas', KlasController::class);
    Route::resource('rombels', RombelController::class);
    Route::resource('mapels', MapelController::class);
    Route::resource('nilais', NilaiController::class);
    Route::resource('laporans', LaporanController::class);
    Route::resource('jadwals', JadwalController::class);
    Route::resource('perencanaans', PerencanaanController::class);
    Route::post('/anggota/{id}', [RombelController::class, 'anggota'])->name('rombels.anggota');
    Route::get('/keluar/{id}', [RombelController::class, 'keluar'])->name('rombels.keluar');
    Route::get('/keluar2/{id}', [RombelController::class, 'keluar2'])->name('rombels.keluar2');
    Route::put('/set_guru/{id}', [RombelController::class, 'set_guru'])->name('rombels.set_guru');
    Route::put('/set_wali/{id}', [RombelController::class, 'set_wali'])->name('rombels.set_wali');
    Route::get('/pembelajaran/{mapel}', [RombelController::class, 'pembelajaran'])->name('rombels.pembelajaran');
    Route::post('/mapel/{id}', [RombelController::class, 'mapel'])->name('rombels.mapel');
    Route::put('/sort', [NilaiController::class, 'sort'])->name('nilais.sort');
    Route::get('/sort3/{id}', [NilaiController::class, 'sort3'])->name('nilais.sort3');
    Route::put('/sort2', [NilaiController::class, 'sort2'])->name('nilais.sort2');
    Route::get('/cetak/{id}', [LaporanController::class, 'cetak'])->name('laporans.cetak');
    Route::get('/nilai_siswa', [LaporanController::class, 'nilai_siswa'])->name('laporans.nilai_siswa');
    Route::get('/lihat/{id}', [JadwalController::class, 'lihat'])->name('jadwals.lihat');
    Route::get('/jadwal_guru', [JadwalController::class, 'jadwal_guru'])->name('jadwals.jadwal_guru');
    Route::get('/jadwal_siswa', [JadwalController::class, 'jadwal_siswa'])->name('jadwals.jadwal_siswa');
    Route::get('/edit2', [PerencanaanController::class, 'edit2'])->name('perencanaans.edit2');

});


Route::get('profile/{user}', function(App\User $user)
{
    //
});
