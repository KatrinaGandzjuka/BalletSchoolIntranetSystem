<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AddTerpiController;
use App\Http\Controllers\AddGrupasController;
use App\Http\Controllers\ViewLietotajiController;
use App\Http\Controllers\ViewGrupasController;
use App\Http\Controllers\ViewTerpiController;
use App\Http\Controllers\DeleteLietotajiController;
use App\Http\Controllers\DeleteGrupasController;
use App\Http\Controllers\DeleteTerpiController;
use App\Http\Controllers\AudzekniGrupasController;
use App\Http\Controllers\PedagogiGrupasController;
use App\Http\Controllers\AudzekniKostimiController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AddNumursController;
use App\Http\Controllers\ViewNumursController;
use App\Http\Controllers\DeleteNumursController;
use App\Http\Controllers\AudzekniNumursController;
use App\Http\Controllers\PedagogiNumursController;
use App\Http\Controllers\KoncertiController;
use App\Http\Controllers\KoncertiNumuriController;
use App\Http\Controllers\PDFController;

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


Route::get('/', [AdminController::class, 'AdminIndex']);
Route::get('/addTerpi', [AddTerpiController::class, 'IndexAddTerpi']);
Route::get('/addGrupas', [AddGrupasController::class, 'IndexAddGrupas']);
Route::get('/viewLietotaji', [ViewLietotajiController::class, 'ViewLietotajiIndex']);
Route::get('/viewGrupas', [ViewGrupasController::class, 'ViewGrupasIndex']);
Route::get('/viewTerpi', [ViewTerpiController::class, 'ViewTerpiIndex']);
Route::get('/redigetLietotajus{personasKods}', [ViewLietotajiController::class, 'LietotajiRedigetIndex']);
Route::get('/redigetGrupas{GrupasNosaukums}', [ViewGrupasController::class, 'GrupasRedigetIndex']);
Route::get('/redigetTerpi{KostimiID}', [ViewTerpiController::class, 'TerpiRedigetIndex']);
Route::get('/dzestLietotajus{personasKods}', [DeleteLietotajiController::class, 'DeleteLietotajiIndex'] );
Route::get('/deleteLietotajiData{personasKods}', [DeleteLietotajiController::class, 'DeleteLietotajiData']);
Route::get('/dzestGrupas{GrupasNosaukums}', [DeleteGrupasController::class, 'DeleteGrupasIndex'] );
Route::get('/deleteGrupasData{GrupasNosaukums}', [DeleteGrupasController::class, 'DeleteGrupasData']);
Route::get('/dzestTerpus{KostimiID}', [DeleteTerpiController::class, 'DeleteTerpiIndex'] );
Route::get('/deleteTerpiData{KostimiID}', [DeleteTerpiController::class, 'DeleteTerpiData']);
Route::get('/audzekniGrupas{GrupasNosaukums}', [AudzekniGrupasController::class, 'AudzekniGrupasIndex'] );
Route::get('/pievAudzAudzekniGrupas{GrupasNosaukums}', [AudzekniGrupasController::class, 'PievAudzAudzekniGrupasIndex'] );
Route::get('/dataInsertAudzekniGrupas{GrupasNosaukums}/{personasKods}', [AudzekniGrupasController::class, 'AudzekniGrupasDataInsert']);
Route::get('/dataDeleteAudzekniGrupas{GrupasNosaukums}/{personasKods}', [AudzekniGrupasController::class, 'AudzekniGrupasDataDelete']);
Route::get('/pievPedPedagogiGrupas{GrupasNosaukums}', [PedagogiGrupasController::class, 'PievPedPedagogiGrupasIndex'] );
Route::get('/dataDeletePedagogiGrupas{GrupasNosaukums}/{personasKods}', [PedagogiGrupasController::class, 'PedagogiGrupasDataDelete']);
Route::get('/iedalitTerpi{KostimiID}', [AudzekniKostimiController::class, 'AudzekniKostimiIndex']);
Route::get('/dataInsertAudzekniKostimi{KostimiID}/{personasKods}', [AudzekniKostimiController::class, 'AudzekniKostimiDataInsert']);
Route::get('/savaktTerpi{KostimiID}', [AudzekniKostimiController::class, 'AudzekniKostimiSavaktIndex']);
Route::get('/dataDeleteAudzekniKostimi{KostimiID}/{personasKods}', [AudzekniKostimiController::class, 'AudzekniKostimiDataDelete']);
Route::get('/iedalitGrupai{KostimiID}', [AudzekniKostimiController::class, 'AudzekniKostimiGrupaIndex']);
Route::get('/dataInsertGrupasKostimi/{KostimiID}/{GrupasAudzeknaNosaukums}', [AudzekniKostimiController::class, 'GrupasKostimiDataInsert']);
Route::get('/login', [LoginController::class, 'LoginIndex']);
Route::get('/audzeknis{personasKods}', [LoginController::class, 'AudzeknisIndex']);
Route::get('/vecaks{personasKods}', [LoginController::class, 'VecaksIndex']);
Route::get('/pedagogs{personasKods}', [LoginController::class, 'PedagogsIndex']);
Route::get('/searchTerpi', [ViewTerpiController::class, 'SearchTerpi']);



Route::post('/dataInsert', [AdminController::class, 'UserDataInsert']);
Route::post('/dataInsertTerpi', [AddTerpiController::class, 'TerpiDataInsert']);
Route::post('/dataInsertGrupas', [AddGrupasController::class, 'GrupasDataInsert']);
Route::post('/dataUpdateLietotaji{personasKods}', [ViewLietotajiController::class, 'DataUpdateLietotaji']);
Route::post('/dataUpdateGrupas{GrupasNosaukums}', [ViewGrupasController::class, 'DataUpdateGrupas']);
Route::post('/dataUpdateTerpi{KostimiID}', [ViewTerpiController::class, 'DataUpdateTerpi']);
Route::post('/dataInsertPedagogiGrupas{GrupasNosaukums}', [PedagogiGrupasController::class, 'PedagogiGrupasDataInsert']);
Route::post('/loginPost', [LoginController::class, 'LoginPost']);

Route::get('/addNumurs', [AddNumursController::class, 'IndexAddNumurs']);
Route::post('/dataInsertNumurs', [AddNumursController::class, 'NumursDataInsert']);
Route::get('/viewNumurs', [ViewNumursController::class, 'ViewNumursIndex']);
Route::get('/redigetNumurs{NumursID}', [ViewNumursController::class, 'NumursRedigetIndex']);
Route::post('/dataUpdateNumurs{NumursID}', [ViewNumursController::class, 'DataUpdateNumurs']);
Route::get('/dzestNumurs{NumursID}', [DeleteNumursController::class, 'DeleteNumursIndex'] );
Route::get('/deleteNumursData{NumursID}', [DeleteNumursController::class, 'DeleteNumursData']);

Route::get('/audzekniNumurs{NumursID}', [AudzekniNumursController::class, 'AudzekniNumursIndex'] );
Route::get('/pievAudzAudzekniNumurs{NumursID}', [AudzekniNumursController::class, 'PievAudzAudzekniNumursIndex'] );
Route::get('/dataInsertAudzekniNumurs{NumursID}/{personasKods}', [AudzekniNumursController::class, 'AudzekniNumursDataInsert']);
Route::get('/dataDeleteAudzekniNumurs{NumursID}/{personasKods}', [AudzekniNumursController::class, 'AudzekniNumursDataDelete']);

Route::get('/pedagogiNumurs{NumursID}', [PedagogiNumursController::class, 'PedagogiNumursIndex']);
Route::get('/pievPedPedagogiNumurs{NumursID}', [PedagogiNumursController::class, 'PievPedPedagogiNumursIndex']);
Route::get('/dataInsertPedagogiNumurs{NumursID}/{personasKods}', [PedagogiNumursController::class, 'PedagogiNumursDataInsert']);
Route::get('/dataDeletePedagogiNumurs{NumursID}/{personasKods}', [PedagogiNumursController::class, 'PedagogiNumursDataDelete']);

Route::get('/koncerti', [KoncertiController::class, 'KoncertiIndex']);
Route::get('/addKoncerts', [KoncertiController::class, 'AddKoncertsIndex']);
Route::post('/dataInsertKoncerts', [KoncertiController::class, 'KoncertsDataInsert']);
Route::get('/editKoncerts/{KoncertsID}', [KoncertiController::class, 'EditKoncertsIndex']);
Route::post('/dataUpdateKoncerts/{KoncertsID}', [KoncertiController::class, 'KoncertsDataUpdate']);
Route::get('/deleteKoncerts/{KoncertsID}', [KoncertiController::class, 'DeleteKoncertsIndex']);
Route::post('/deleteKoncertsData/{KoncertsID}', [KoncertiController::class, 'KoncertsDataDelete']);

Route::get('/koncertiNumuri{KoncertsID}', [KoncertiNumuriController::class, 'KoncertiNumuriIndex']);
Route::get('/pievNumuriKoncertam{KoncertsID}', [KoncertiNumuriController::class, 'PievNumuriKoncertamIndex']);
Route::post('/dataInsertKoncertiNumuri{KoncertsID}/{NumursID}', [KoncertiNumuriController::class, 'KoncertiNumuriDataInsert']);
Route::get('/dataDeleteKoncertiNumuri/{KoncertsNumursID}', [KoncertiNumuriController::class, 'KoncertiNumuriDataDelete']);

Route::get('/exportGrupasPDF/{GrupasNosaukums}', [PDFController::class, 'generateGrupasPDF']);
Route::get('/exportTerpiPDF', [PDFController::class, 'generateTerpiPDF'])->name('exportTerpiPDF');
Route::get('/exportKoncertsPDF/{KoncertsID}', [PDFController::class, 'generateKoncertsPDF'])->name('exportKoncertsPDF');
Route::get('/export-koncerts-kostimi-pdf/{koncertsID}', [PDFController::class, 'exportKoncertsKostimiPDF'])->name('export_koncerts_kostimi_pdf');
Route::get('/exportPedagogsTerpiPDF/{personasKods}/{koncertsId}', [PDFController::class, 'exportPedagogsTerpiPDF']);
Route::get('/exportPedagogsNumuriPDF/{personasKods}/{koncertsID}', [PDFController::class, 'exportPedagogsNumuriPDF']);
Route::get('/exportAudzeknisTerpiPDF/{personasKods}/{koncertsID}', [PDFController::class, 'exportAudzeknisTerpiPDF']);




