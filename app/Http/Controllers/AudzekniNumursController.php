<?php

/**
 * Šis kontrolieris nodrošina audzēkņu pievienošanu un noņemšanu no numuriem baletskolas sistēmā.
 * Tas satur četras galvenās funkcijas:
 * - AudzekniNumursIndex(): Parāda audzēkņu sarakstu, kuri ir pievienoti konkrētam numuram.
 * - PievAudzAudzekniNumursIndex(): Parāda audzēkņu sarakstu, kuri nav pievienoti konkrētam numuram.
 * - AudzekniNumursDataInsert(): Pievieno audzēkni numuram un atjauno sarakstu.
 * - AudzekniNumursDataDelete(): Noņem audzēkni no numura un atjauno sarakstu.
 * 
 * Nosaukums: App\Http\Controllers
 * Izmantotie modeļi: AudzeknisNumurs_tabula, Numurs_tabula, Lietotajs_tabula, Lomas_tabula, AudzeknisGrupa_tabula
 * Izmantotie skati: audzekniNumurs, pievAudzAudzekniNumurs
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AudzeknisNumurs_tabula;
use App\Models\Numurs_tabula;
use App\Models\Lietotajs_tabula;
use App\Models\Lomas_tabula;
use App\Models\AudzeknisGrupa_tabula;

class AudzekniNumursController extends Controller
{
    /**
     * Parāda audzēkņu sarakstu, kuri ir pievienoti konkrētam numuram.
     *
     * @param int $NumursID
     * @return \Illuminate\View\View
     */
    public function AudzekniNumursIndex($NumursID)
    {
        $LietotajsData = Lietotajs_tabula::where('LomaID', 1)
            ->whereExists(function ($subquery) use ($NumursID) {
                $subquery
                    ->select('*')
                    ->from('audzeknisnumurs')
                    ->whereRaw('AudzeknaNumuraPersonasKods = personasKods')
                    ->where('NumursIDAudzeknis', $NumursID);
            })
            ->get();

        foreach ($LietotajsData as $lietotajs) {
            $grupa = AudzeknisGrupa_tabula::where('AudzeknaGrupasPersonasKods', $lietotajs->personasKods)
                ->join('grupa', 'grupa.GrupasNosaukums', '=', 'audzeknisgrupa.GrupasAudzeknaNosaukums')
                ->select('grupa.GrupasNosaukums')
                ->first();
            $lietotajs->grupa = $grupa ? $grupa->GrupasNosaukums : 'N/A';
        }

        $LomasData = Lomas_tabula::all();
        $NumursData = Numurs_tabula::find($NumursID);

        return view('audzekniNumurs', [
            'LietotajsData' => $LietotajsData,
            'LomasData' => $LomasData,
            'NumursData' => $NumursData,
        ]);
    }

    /**
     * Parāda audzēkņu sarakstu, kuri nav pievienoti konkrētam numuram.
     *
     * @param int $NumursID
     * @return \Illuminate\View\View
     */
    public function PievAudzAudzekniNumursIndex($NumursID)
    {
        $LietotajsData = Lietotajs_tabula::where('LomaID', 1)
            ->whereNotExists(function ($query) use ($NumursID) {
                $query
                    ->select('*')
                    ->from('audzeknisnumurs')
                    ->whereRaw('AudzeknaNumuraPersonasKods = personasKods')
                    ->where('NumursIDAudzeknis', $NumursID);
            })
            ->get();

        foreach ($LietotajsData as $lietotajs) {
            $grupa = AudzeknisGrupa_tabula::where('AudzeknaGrupasPersonasKods', $lietotajs->personasKods)
                ->join('grupa', 'grupa.GrupasNosaukums', '=', 'audzeknisgrupa.GrupasAudzeknaNosaukums')
                ->select('grupa.GrupasNosaukums')
                ->first();
            $lietotajs->grupa = $grupa ? $grupa->GrupasNosaukums : 'N/A';
        }

        $LomasData = Lomas_tabula::all();
        $NumursData = Numurs_tabula::find($NumursID);

        return view('pievAudzAudzekniNumurs', [
            'NumursData' => $NumursData,
            'LietotajsData' => $LietotajsData,
            'LomasData' => $LomasData,
        ]);
    }

    /**
     * Pievieno audzēkni numuram un atjauno sarakstu.
     *
     * @param int $NumursID
     * @param string $personasKods
     * @return \Illuminate\View\View
     */
    public function AudzekniNumursDataInsert($NumursID, $personasKods)
    {
        $isAudzekniNumursInsertSuccess = AudzeknisNumurs_tabula::insert([
            "AudzeknaNumuraPersonasKods" => $personasKods,
            "NumursIDAudzeknis" => $NumursID,
        ]);

        if ($isAudzekniNumursInsertSuccess) {
            echo '<script>alert("Audzēknis tika pievienots numuram ;)");</script>';
        } else {
            echo '<script>alert("Audzēknis netika pievienots numuram :(");</script>';
        }

        return $this->AudzekniNumursIndex($NumursID);
    }

    /**
     * Noņem audzēkni no numura un atjauno sarakstu.
     *
     * @param int $NumursID
     * @param string $personasKods
     * @return \Illuminate\View\View
     */
    public function AudzekniNumursDataDelete($NumursID, $personasKods)
    {
        $isAudzekniNumursDeleteSuccess = AudzeknisNumurs_tabula::where([
            ['NumursIDAudzeknis', '=', $NumursID],
            ['AudzeknaNumuraPersonasKods', '=', $personasKods],
        ])->delete();

        if ($isAudzekniNumursDeleteSuccess) {
            echo '<script>alert("Audzēknis tika izdzēsts no numura");</script>';
        } else {
            echo '<script>alert("Audzēknis netika izdzēsts no numura");</script>';
        }

        return $this->PievAudzAudzekniNumursIndex($NumursID);
    }
}
