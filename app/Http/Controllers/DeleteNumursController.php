<?php

/**
 * Šis kontrolieris nodrošina numuru dzēšanu baletskolas sistēmā.
 * Tas satur divas galvenās funkcijas:
 * - DeleteNumursIndex(): Parāda lapu, kurā var apstiprināt numura dzēšanu.
 * - DeleteNumursData(): Dzēš norādīto numuru un atjauno numuru sarakstu.
 * 
 * Nosaukums: App\Http\Controllers
 * Izmantotie modeļi: Numurs_tabula
 * Izmantotie skati: deleteNumurs, viewNumurs
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Numurs_tabula;

class DeleteNumursController extends Controller
{
    /**
     * Parāda lapu, kurā var apstiprināt numura dzēšanu.
     *
     * @param int $NumursID
     * @return \Illuminate\View\View
     */
    function DeleteNumursIndex($NumursID)
    {
        return view("deleteNumurs", ["NumursID" => $NumursID]);
    }

    /**
     * Dzēš norādīto numuru un atjauno numuru sarakstu.
     *
     * @param int $NumursID
     * @return \Illuminate\View\View
     */
    function DeleteNumursData($NumursID)
    {
        $isDeleteSuccess = Numurs_tabula::where(
            "NumursID",
            $NumursID
        )->delete();

        if ($isDeleteSuccess) {
            echo '<script>alert("Numurs tika izdzēsts");</script>';
        } else {
            echo '<script>alert("Numurs netika izdzēsts");</script>';
        }

        $NumursData = Numurs_tabula::all();
        return view("viewNumurs", ["NumursData" => $NumursData]);
    }
}
