<?php

/**
 * Šis kontrolieris nodrošina grupu dzēšanu baletskolas sistēmā.
 * Tas satur divas galvenās funkcijas:
 * - DeleteGrupasIndex(): Parāda lapu, kurā var apstiprināt grupas dzēšanu.
 * - DeleteGrupasData(): Dzēš norādīto grupu un atjauno grupu sarakstu.
 * 
 * Nosaukums: App\Http\Controllers
 * Izmantotie modeļi: Grupas_tabula
 * Izmantotie skati: deleteGrupas, viewGrupas
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grupas_tabula;

class DeleteGrupasController extends Controller
{
    /**
     * Parāda lapu, kurā var apstiprināt grupas dzēšanu.
     *
     * @param string $GrupasNosaukums
     * @return \Illuminate\View\View
     */
    function DeleteGrupasIndex($GrupasNosaukums)
    {
        return view("deleteGrupas", ["GrupasNosaukums" => $GrupasNosaukums]);
    }

    /**
     * Dzēš norādīto grupu un atjauno grupu sarakstu.
     *
     * @param string $GrupasNosaukums
     * @return \Illuminate\View\View
     */
    function DeleteGrupasData($GrupasNosaukums)
    {
        $isDeleteSuccess = Grupas_tabula::where(
            "GrupasNosaukums",
            $GrupasNosaukums
        )->delete();

        if ($isDeleteSuccess) {
            echo '<script>alert("Grupa tika izdzēsta");</script>';
        } else {
            echo '<script>alert("Grupa netika izdzēsta");</script>';
        }
        
        $GrupasData = Grupas_tabula::all();
        return view("viewGrupas", ["GrupasData" => $GrupasData]);
    }
}
