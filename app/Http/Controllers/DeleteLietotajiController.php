<?php

/**
 * Šis kontrolieris nodrošina lietotāju dzēšanu baletskolas sistēmā.
 * Tas satur divas galvenās funkcijas:
 * - DeleteLietotajiIndex(): Parāda lapu, kurā var apstiprināt lietotāja dzēšanu.
 * - DeleteLietotajiData(): Dzēš norādīto lietotāju un atjauno lietotāju sarakstu.
 * 
 * Nosaukums: App\Http\Controllers
 * Izmantotie modeļi: Lietotajs_tabula, Lomas_tabula
 * Izmantotie skati: deleteLietotaji, viewLietotaji
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lietotajs_tabula;
use App\Models\Lomas_tabula;

class DeleteLietotajiController extends Controller
{
    /**
     * Parāda lapu, kurā var apstiprināt lietotāja dzēšanu.
     *
     * @param string $personasKods
     * @return \Illuminate\View\View
     */
    function DeleteLietotajiIndex($personasKods)
    {
        return view("deleteLietotaji", ["personasKods" => $personasKods]);
    }

    /**
     * Dzēš norādīto lietotāju un atjauno lietotāju sarakstu.
     *
     * @param string $personasKods
     * @return \Illuminate\View\View
     */
    function DeleteLietotajiData($personasKods)
    {
        $isDeleteSuccess = Lietotajs_tabula::where(
            "personasKods",
            $personasKods
        )->delete();

        if ($isDeleteSuccess) {
            echo '<script>alert("Lietotājs tika izdzēsts");</script>';
        } else {
            echo '<script>alert("Lietotājs netika izdzēsts");</script>';
        }
        
        $LietotajsData = Lietotajs_tabula::all();
        $LomasData = Lomas_tabula::all();
        
        return view("viewLietotaji", [
            "LietotajsData" => $LietotajsData,
            "LomasData" => $LomasData
        ]);
    }
}
