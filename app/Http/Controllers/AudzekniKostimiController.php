<?php

/**
 * Šis kontrolieris nodrošina audzēkņu kostīmu piešķiršanu un savākšanu baletskolas sistēmā.
 * Tas satur piecas galvenās funkcijas:
 * - AudzekniKostimiIndex(): Parāda audzēkņu sarakstu, kuriem nav piešķirts kostīms.
 * - AudzekniKostimiDataInsert(): Pievieno kostīmu audzēknim un atjauno sarakstu.
 * - AudzekniKostimiSavaktIndex(): Parāda audzēkņu sarakstu, kuriem ir piešķirts kostīms.
 * - AudzekniKostimiDataDelete(): Noņem kostīmu no audzēkņa un atjauno sarakstu.
 * - AudzekniKostimiGrupaIndex(): Parāda grupu un audzēkņu sarakstu ar piešķirtajiem kostīmiem.
 * 
 * Nosaukums: App\Http\Controllers
 * Izmantotie modeļi: AudzekniKostimi_tabula, Terpi_tabula, Lietotajs_tabula, Lomas_tabula, AudzeknisGrupa_tabula, Grupas_tabula
 * Izmantotie skati: audzekniKostimi, audzekniKostimiSavakt, audzekniKostimiGrupas
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\AudzekniKostimi_tabula;
use App\Models\Terpi_tabula;
use App\Models\Lietotajs_tabula;
use App\Models\Lomas_tabula;
use App\Models\AudzeknisGrupa_tabula;
use App\Models\Grupas_tabula;

class AudzekniKostimiController extends Controller
{
    /**
     * Parāda audzēkņu sarakstu, kuriem nav piešķirts kostīms.
     *
     * @param int $KostimiID
     * @return \Illuminate\View\View
     */
    function AudzekniKostimiIndex($KostimiID)
    {
        $LietotajsData = Lietotajs_tabula::where("LomaID", 1)
            ->whereNotExists(function ($query) use ($KostimiID) {
                $query
                    ->select("*")
                    ->from("audzeknikostimi")
                    ->whereRaw("AudzeknaKostimaPersonasKods = PersonasKods")
                    ->where("KostimiID", $KostimiID);
            })
            ->leftJoin(
                "audzeknisgrupa",
                "lietotajs.personasKods",
                "=",
                "audzeknisgrupa.AudzeknaGrupasPersonasKods"
            )
            ->get([
                "lietotajs.personasKods",
                "lietotajs.Vards",
                "lietotajs.Uzvards",
                "audzeknisgrupa.GrupasAudzeknaNosaukums",
            ]);
        $LomasData = Lomas_tabula::all();
        $KostimiData = Terpi_tabula::all();
        return view("audzekniKostimi", [
            "KostimiID" => $KostimiID,
            "LietotajsData" => $LietotajsData,
            "LomasData" => $LomasData,
        ]);
    }

    /**
     * Pievieno kostīmu audzēknim un atjauno sarakstu.
     *
     * @param int $KostimiID
     * @param string $personasKods
     * @return \Illuminate\Http\RedirectResponse
     */
    function AudzekniKostimiDataInsert($KostimiID, $personasKods)
    {
        $date = date("Y-m-d");

        $isAudzekniKostimiInsertSuccess = AudzekniKostimi_tabula::insert([
            "PiesDatums" => $date,
            "AudzeknaKostimaPersonasKods" => $personasKods,
            "KostimiID" => $KostimiID,
        ]);
        if ($isAudzekniKostimiInsertSuccess) {
            return back()->with(["success" => true]);
        } else {
            return back()->with(["success" => false]);
        }
    }

    /**
     * Parāda audzēkņu sarakstu, kuriem ir piešķirts kostīms.
     *
     * @param int $KostimiID
     * @return \Illuminate\View\View
     */
    function AudzekniKostimiSavaktIndex($KostimiID)
    {
        $LietotajsData = Lietotajs_tabula::where("LomaID", 1)
            ->whereExists(function ($query) use ($KostimiID) {
                $query
                    ->select("*")
                    ->from("audzeknikostimi")
                    ->whereRaw("AudzeknaKostimaPersonasKods = PersonasKods")
                    ->where("KostimiID", $KostimiID);
            })
            ->leftJoin(
                "audzeknisgrupa",
                "lietotajs.personasKods",
                "=",
                "audzeknisgrupa.AudzeknaGrupasPersonasKods"
            )
            ->get([
                "lietotajs.personasKods",
                "lietotajs.Vards",
                "lietotajs.Uzvards",
                "audzeknisgrupa.GrupasAudzeknaNosaukums",
            ]);
        $LomasData = Lomas_tabula::all();
        $KostimiData = Terpi_tabula::all();
        return view("audzekniKostimiSavakt", [
            "KostimiID" => $KostimiID,
            "LietotajsData" => $LietotajsData,
            "LomasData" => $LomasData,
        ]);
    }

    /**
     * Noņem kostīmu no audzēkņa un atjauno sarakstu.
     *
     * @param int $KostimiID
     * @param string $personasKods
     * @return \Illuminate\Http\RedirectResponse
     */
    function AudzekniKostimiDataDelete($KostimiID, $personasKods)
    {
        $isAudzekniKostimiDeleteSuccess = AudzekniKostimi_tabula::where([
            ["KostimiID", "=", $KostimiID],
            ["AudzeknaKostimaPersonasKods", "=", $personasKods],
        ])->delete();

        if ($isAudzekniKostimiDeleteSuccess) {
            return back()->with(["success" => true]);
        } else {
            return back()->with(["success" => false]);
        }
    }

    /**
     * Parāda grupu un audzēkņu sarakstu ar piešķirtajiem kostīmiem.
     *
     * @param int $KostimiID
     * @return \Illuminate\View\View
     */
    function AudzekniKostimiGrupaIndex($KostimiID)
    {
        $GrupasData = Grupas_tabula::all();
        $KostimiData = Terpi_tabula::all();
        $audzekniKostimiData = AudzekniKostimi_tabula::all();
        return view("audzekniKostimiGrupas", [
            "KostimiID" => $KostimiID,
            "GrupasData" => $GrupasData,
            "audzekniKostimiData" => $audzekniKostimiData,
        ]);
    }
}
