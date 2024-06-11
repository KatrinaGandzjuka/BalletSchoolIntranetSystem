<?php

/**
 * Šis kontrolieris nodrošina kostīmu dzēšanu baletskolas sistēmā.
 * Tas satur divas galvenās funkcijas:
 * - DeleteTerpiIndex(): Parāda lapu, kurā var apstiprināt kostīma dzēšanu.
 * - DeleteTerpiData(): Dzēš norādīto kostīmu un atjauno kostīmu sarakstu.
 * 
 * Nosaukums: App\Http\Controllers
 * Izmantotie modeļi: Terpi_tabula
 * Izmantotie skati: deleteTerpi, viewTerpi
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Terpi_tabula;

class DeleteTerpiController extends Controller
{
    /**
     * Parāda lapu, kurā var apstiprināt kostīma dzēšanu.
     *
     * @param int $KostimiID
     * @return \Illuminate\View\View
     */
    function DeleteTerpiIndex($KostimiID)
    {
        return view("deleteTerpi", ["KostimiID" => $KostimiID]);
    }

    /**
     * Dzēš norādīto kostīmu un atjauno kostīmu sarakstu.
     *
     * @param int $KostimiID
     * @return \Illuminate\View\View
     */
    function DeleteTerpiData($KostimiID)
    {
        $isDeleteSuccess = Terpi_tabula::where(
            "KostimiID",
            $KostimiID
        )->delete();

        if ($isDeleteSuccess) {
            echo '<script>alert("Kostīms tika izdzēsts");</script>';
        } else {
            echo '<script>alert("Kostīms netika izdzēsts");</script>';
        }

        $TerpiData = Terpi_tabula::all();
        return view("viewTerpi", ["TerpiData" => $TerpiData]);
    }
}
