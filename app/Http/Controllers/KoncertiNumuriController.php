<?php

/**
 * Šis kontrolieris nodrošina koncertu numuru pārvaldību baletskolas sistēmā.
 * Tas satur piecas galvenās funkcijas:
 * - KoncertiNumuriIndex(): Parāda visus numurus, kas pievienoti konkrētajam koncertam.
 * - PievNumuriKoncertamIndex(): Parāda lapu numuru pievienošanai koncertam.
 * - KoncertiNumuriDataInsert(): Pievieno jaunu numuru koncertam datubāzei.
 * - KoncertiNumuriDataDelete(): Dzēš numuru no koncerta un atjauno numuru sarakstu.
 * 
 * Nosaukums: App\Http\Controllers
 * Izmantotie modeļi: Koncerts_tabula, Numurs_tabula, KoncertsNumurs_tabula
 * Izmantotie skati: koncertiNumuri, pievNumuriKoncertam
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Koncerts_tabula;
use App\Models\Numurs_tabula;
use App\Models\KoncertsNumurs_tabula;

class KoncertiNumuriController extends Controller
{
    /**
     * Parāda visus numurus, kas pievienoti konkrētajam koncertam.
     */
    public function KoncertiNumuriIndex($KoncertsID)
    {
        $NumuriData = Numurs_tabula::join('koncertsnumurs', 'numurs.NumursID', '=', 'koncertsnumurs.NumursIDKoncNumurs')
            ->join('kostimi', 'numurs.KostimiIDnumurs', '=', 'kostimi.KostimiID')
            ->where('koncertsnumurs.KoncertsIDKoncNumurs', $KoncertsID)
            ->orderBy('koncertsnumurs.KartasNumurs')
            ->get(['numurs.*', 'koncertsnumurs.KartasNumurs', 'koncertsnumurs.KoncertsNumursID', 'kostimi.Nosaukums']);
            
        $koncerts = Koncerts_tabula::find($KoncertsID);

        return view('koncertiNumuri', [
            'NumuriData' => $NumuriData,
            'koncerts' => $koncerts,
        ]);
    }

    /**
     * Parāda lapu numuru pievienošanai koncertam.
     */
    public function PievNumuriKoncertamIndex($KoncertsID)
    {
        $NumuriData = Numurs_tabula::whereNotExists(function ($query) use ($KoncertsID) {
            $query
                ->select('*')
                ->from('koncertsnumurs')
                ->whereRaw('koncertsnumurs.NumursIDKoncNumurs = numurs.NumursID')
                ->where('koncertsnumurs.KoncertsIDKoncNumurs', $KoncertsID);
        })->get();

        return view('pievNumuriKoncertam', [
            'KoncertsID' => $KoncertsID,
            'NumuriData' => $NumuriData,
        ]);
    }

    /**
     * Pievieno jaunu numuru koncertam datubāzei.
     */
    public function KoncertiNumuriDataInsert(Request $request, $KoncertsID, $NumursID)
    {
        $kartasNumurs = $request->input('KartasNumurs');
        $isInsertSuccess = KoncertsNumurs_tabula::insert([
            "KoncertsIDKoncNumurs" => $KoncertsID,
            "KartasNumurs" => $kartasNumurs,
            "NumursIDKoncNumurs" => $NumursID,
        ]);

        if ($isInsertSuccess) {
            echo '<script>alert("Numurs tika pievienots koncertam ;)");</script>';
        } else {
            echo '<script>alert("Numurs netika pievienots koncertam :(");</script>';
        }

        return redirect()->back();
    }

    /**
     * Dzēš numuru no koncerta un atjauno numuru sarakstu.
     */
    public function KoncertiNumuriDataDelete($KoncertsNumursID)
    {
        $isDeleteSuccess = KoncertsNumurs_tabula::where('KoncertsNumursID', $KoncertsNumursID)->delete();

        if ($isDeleteSuccess) {
            echo '<script>alert("Numurs tika izdzēsts no koncerta ;)");</script>';
        } else {
            echo '<script>alert("Numurs netika izdzēsts no koncerta :(");</script>';
        }

        return redirect()->back();
    }
}
