<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Numurs_tabula;
use App\Models\Terpi_tabula;

/**
 * ViewNumursController nodrošina funkcijas numuru datu skatīšanai un rediģēšanai.
 * Tas ietver metodes numuru saraksta skatīšanai, numuru datu rediģēšanai un numuru datu atjaunināšanai.
 * 
 * Nosaukums: App\Http\Controllers
 * Izmantotie modeļi: Numurs_tabula, Terpi_tabula
 * Izmantotie skati: viewNumurs, numursRediget
 */
class ViewNumursController extends Controller
{
    /**
     * Ģenerē skatu ar numuru sarakstu.
     */
    public function ViewNumursIndex()
    {
        $NumursData = Numurs_tabula::join('kostimi', 'numurs.KostimiIDnumurs', '=', 'kostimi.KostimiID')
            ->get(['numurs.*', 'kostimi.Nosaukums']);
            
        return view('viewNumurs', ['NumursData' => $NumursData]);
    }

    /**
     * Ģenerē skatu numura datu rediģēšanai.
     */
    public function NumursRedigetIndex($NumursID)
    {
        $NumursData = Numurs_tabula::where('NumursID', $NumursID)->first();
        $KostimiData = Terpi_tabula::all();
        return view('numursRediget', ['nd' => $NumursData, 'KostimiData' => $KostimiData]);
    }

    /**
     * Atjaunina numura datus.
     */
    public function DataUpdateNumurs(Request $request)
    {
        $NumursID = $request->NumursID;
        $numurs = Numurs_tabula::find($NumursID);
        $numurs->NumuraNosaukums = $request->input('NumuraNosaukums');
        $numurs->Garums = $request->input('Garums');
        $numurs->Muzika = $request->input('Muzika');
        $numurs->Horeografija = $request->input('Horeografija');
        $numurs->IzpilditajuSkaits = $request->input('IzpilditajuSkaits');
        $numurs->KostimiIDnumurs = $request->input('KostimiIDnumurs');
        $isUpdateSuccess = $numurs->save();

        if ($isUpdateSuccess) {
            echo '<script>alert("Numura dati veiksmīgi rediģēti ;)");</script>';
        } else {
            echo '<script>alert("Numura dati netika rediģēti :(");</script>';
        }

        $NumursData = Numurs_tabula::join('kostimi', 'numurs.KostimiIDnumurs', '=', 'kostimi.KostimiID')
            ->get(['numurs.*', 'kostimi.Nosaukums']);
            
        return view('viewNumurs', ['NumursData' => $NumursData]);
    }
}
