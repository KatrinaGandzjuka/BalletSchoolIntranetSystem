<?php

/**
 * PedagogiNumursController nodrošina funkcijas pedagogu pievienošanai un dzēšanai no numuriem.
 * Tas ietver metodes pedagogu pievienošanai numuriem, pedagogu pievienošanas skatu ģenerēšanai un pedagogu dzēšanai no numuriem.
 * 
 * Nosaukums: App\Http\Controllers
 * Izmantotie modeļi: PedagogsNumurs_tabula, Numurs_tabula, Lietotajs_tabula, Lomas_tabula
 * Izmantotie skati: pedagogiNumurs, pievPedPedagogiNumurs
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PedagogsNumurs_tabula;
use App\Models\Numurs_tabula;
use App\Models\Lietotajs_tabula;
use App\Models\Lomas_tabula;

class PedagogiNumursController extends Controller
{
    /**
     * Ģenerē skatu ar pedagogu sarakstu, kas ir saistīti ar konkrētu numuru.
     */
    public function PedagogiNumursIndex($NumursID)
    {
        $LietotajsData = Lietotajs_tabula::where('LomaID', 3)
            ->whereExists(function ($subquery) use ($NumursID) {
                $subquery
                    ->select('*')
                    ->from('pedagogsnumurs')
                    ->whereRaw('PedagogaNumuraPersonasKods = personasKods')
                    ->where('NumursIDPedagogs', $NumursID);
            })
            ->get();

        $LomasData = Lomas_tabula::all();
        $NumursData = Numurs_tabula::find($NumursID);

        return view('pedagogiNumurs', [
            'LietotajsData' => $LietotajsData,
            'LomasData' => $LomasData,
            'NumursData' => $NumursData,
        ]);
    }

    /**
     * Ģenerē skatu pedagogu pievienošanai numuram.
     */
    public function PievPedPedagogiNumursIndex($NumursID)
    {
        $LietotajsData = Lietotajs_tabula::where('LomaID', 3)
            ->whereNotExists(function ($query) use ($NumursID) {
                $query
                    ->select('*')
                    ->from('pedagogsnumurs')
                    ->whereRaw('PedagogaNumuraPersonasKods = personasKods')
                    ->where('NumursIDPedagogs', $NumursID);
            })
            ->get();

        $LomasData = Lomas_tabula::all();
        $NumursData = Numurs_tabula::find($NumursID);

        return view('pievPedPedagogiNumurs', [
            'NumursData' => $NumursData,
            'LietotajsData' => $LietotajsData,
            'LomasData' => $LomasData,
        ]);
    }

    /**
     * Pievieno pedagogu numuram.
     */
    public function PedagogiNumursDataInsert($NumursID, $personasKods)
    {
        $isPedagogiNumursInsertSuccess = PedagogsNumurs_tabula::insert([
            "PedagogaNumuraPersonasKods" => $personasKods,
            "NumursIDPedagogs" => $NumursID,
        ]);

        if ($isPedagogiNumursInsertSuccess) {
            echo '<script>alert("Pedagogs tika pievienots numuram ;)");</script>';
        } else {
            echo '<script>alert("Pedagogs netika pievienots numuram :(");</script>';
        }

        return $this->PedagogiNumursIndex($NumursID);
    }

    /**
     * Dzēš pedagogu no numura.
     */
    public function PedagogiNumursDataDelete($NumursID, $personasKods)
    {
        $isPedagogiNumursDeleteSuccess = PedagogsNumurs_tabula::where([
            ['NumursIDPedagogs', '=', $NumursID],
            ['PedagogaNumuraPersonasKods', '=', $personasKods],
        ])->delete();

        if ($isPedagogiNumursDeleteSuccess) {
            echo '<script>alert("Pedagogs tika izdzēsts no numura");</script>';
        } else {
            echo '<script>alert("Pedagogs netika izdzēsts no numura");</script>';
        }

        return $this->PievPedPedagogiNumursIndex($NumursID);
    }
}
