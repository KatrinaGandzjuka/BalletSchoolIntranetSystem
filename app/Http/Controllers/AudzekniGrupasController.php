<?php

/**
 * Šis kontrolieris nodrošina audzēkņu pievienošanu un dzēšanu no grupām baletskolas sistēmā.
 * Tas satur četras galvenās funkcijas:
 * - AudzekniGrupasIndex(): Parāda audzēkņu un pedagogu sarakstu grupai.
 * - PievAudzAudzekniGrupasIndex(): Parāda audzēkņu sarakstu, kuri vēl nav pievienoti grupai.
 * - AudzekniGrupasDataInsert(): Pievieno audzēkni grupai un atjauno sarakstu.
 * - AudzekniGrupasDataDelete(): Izdzēš audzēkni no grupas un atjauno sarakstu.
 * 
 * AudzekniGrupasDataInsert un AudzekniGrupasDataDelete funkcijas apstrādā pieprasījumus,
 * veic nepieciešamās datubāzes operācijas un atgriež attiecīgos skatus ar atjaunoto informāciju.
 * 
 * Nosaukums: App\Http\Controllers
 * Izmantotie modeļi: AudzeknisGrupa_tabula, Grupas_tabula, Lietotajs_tabula, Lomas_tabula
 * Izmantotie skati: audzekniGrupas, pievAudzAudzekniGrupas
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AudzeknisGrupa_tabula;
use App\Models\Grupas_tabula;
use App\Models\Lietotajs_tabula;
use App\Models\Lomas_tabula;

class AudzekniGrupasController extends Controller
{
    /**
     * Parāda audzēkņu un pedagogu sarakstu grupai.
     *
     * @param string $GrupasNosaukums
     * @return \Illuminate\View\View
     */
    function AudzekniGrupasIndex($GrupasNosaukums)
    {
        $LietotajsData = Lietotajs_tabula::whereIn("LomaID", [1, 3])
            ->where(function ($query) use ($GrupasNosaukums) {
                $query
                    ->whereExists(function ($subquery) use ($GrupasNosaukums) {
                        $subquery
                            ->select("*")
                            ->from("audzeknisgrupa")
                            ->whereRaw(
                                "AudzeknaGrupasPersonasKods = personasKods"
                            )
                            ->where(
                                "GrupasAudzeknaNosaukums",
                                $GrupasNosaukums
                            );
                    })
                    ->orWhereExists(function ($subquery) use (
                        $GrupasNosaukums
                    ) {
                        $subquery
                            ->select("*")
                            ->from("pedagogsgrupa")
                            ->whereRaw("PedagogaPersonasKods = personasKods")
                            ->where(
                                "GrupasPedagogaNosaukums",
                                $GrupasNosaukums
                            );
                    });
            })
            ->get();

        $LomasData = Lomas_tabula::all();
        $GrupasData = Grupas_tabula::all();

        return view("audzekniGrupas", [
            "LietotajsData" => $LietotajsData,
            "LomasData" => $LomasData,
            "GrupasNosaukums" => $GrupasNosaukums,
            "GrupasData" => $GrupasData,
        ]);
    }

    /**
     * Parāda audzēkņu sarakstu, kuri vēl nav pievienoti grupai.
     *
     * @param string $GrupasNosaukums
     * @return \Illuminate\View\View
     */
    function PievAudzAudzekniGrupasIndex($GrupasNosaukums)
    {
        $LietotajsData = Lietotajs_tabula::where("LomaID", 1)
            ->whereNotExists(function ($query) use ($GrupasNosaukums) {
                $query
                    ->select("*")
                    ->from("audzeknisgrupa")
                    ->whereRaw("AudzeknaGrupasPersonasKods = PersonasKods")
                    ->where("GrupasAudzeknaNosaukums", $GrupasNosaukums);
            })
            ->get();

        $LomasData = Lomas_tabula::all();
        $GrupasData = Grupas_tabula::all();

        return view("pievAudzAudzekniGrupas", [
            "GrupasNosaukums" => $GrupasNosaukums,
            "LietotajsData" => $LietotajsData,
            "LomasData" => $LomasData,
        ]);
    }

    /**
     * Pievieno audzēkni grupai un atjauno sarakstu.
     *
     * @param string $GrupasNosaukums
     * @param string $personasKods
     * @return \Illuminate\View\View
     */
    function AudzekniGrupasDataInsert($GrupasNosaukums, $personasKods)
    {
        $date = date("Y-m-d");
        $isAudzekniGrupasInsertSuccess = AudzeknisGrupa_tabula::insert([
            "PienDatums" => $date,
            "AudzeknaGrupasPersonasKods" => $personasKods,
            "GrupasAudzeknaNosaukums" => $GrupasNosaukums,
        ]);

        if ($isAudzekniGrupasInsertSuccess) {
            echo '<script>alert("Audzēknis tika pievienots grupai ;)");</script>';
        } else {
            echo '<script>alert("Audzēknis netika pievienots grupai :(");</script>';
        }

        $LietotajsData = Lietotajs_tabula::whereIn("LomaID", [1, 3])
            ->where(function ($query) use ($GrupasNosaukums) {
                $query
                    ->whereExists(function ($subquery) use ($GrupasNosaukums) {
                        $subquery
                            ->select("*")
                            ->from("audzeknisgrupa")
                            ->whereRaw(
                                "AudzeknaGrupasPersonasKods = personasKods"
                            )
                            ->where(
                                "GrupasAudzeknaNosaukums",
                                $GrupasNosaukums
                            );
                    })
                    ->orWhereExists(function ($subquery) use (
                        $GrupasNosaukums
                    ) {
                        $subquery
                            ->select("*")
                            ->from("pedagogsgrupa")
                            ->whereRaw("PedagogaPersonasKods = personasKods")
                            ->where(
                                "GrupasPedagogaNosaukums",
                                $GrupasNosaukums
                            );
                    });
            })
            ->get();

        $LomasData = Lomas_tabula::all();
        $GrupasData = Grupas_tabula::all();

        return view("audzekniGrupas", [
            "LietotajsData" => $LietotajsData,
            "LomasData" => $LomasData,
            "GrupasNosaukums" => $GrupasNosaukums,
            "GrupasData" => $GrupasData,
        ]);
    }

    /**
     * Izdzēš audzēkni no grupas un atjauno sarakstu.
     *
     * @param string $GrupasNosaukums
     * @param string $personasKods
     * @return \Illuminate\View\View
     */
    function AudzekniGrupasDataDelete($GrupasNosaukums, $personasKods)
    {
        $isAudzekniGrupasDeleteSuccess = AudzeknisGrupa_tabula::where([
            ["GrupasAudzeknaNosaukums", "=", $GrupasNosaukums],
            ["AudzeknaGrupasPersonasKods", "=", $personasKods],
        ])->delete();

        if ($isAudzekniGrupasDeleteSuccess) {
            echo '<script>alert("Audzēknis tika izdzēsts no grupas");</script>';
        } else {
            echo '<script>alert("Audzēknis netika izdzēsts no grupas");</script>';
        }
        $LietotajsData = Lietotajs_tabula::where("LomaID", 1)
            ->whereNotExists(function ($query) use ($GrupasNosaukums) {
                $query
                    ->select("*")
                    ->from("audzeknisgrupa")
                    ->whereRaw("AudzeknaGrupasPersonasKods = PersonasKods")
                    ->where("GrupasAudzeknaNosaukums", $GrupasNosaukums);
            })
            ->get();

        $LomasData = Lomas_tabula::all();
        $GrupasData = Grupas_tabula::all();

        return view("pievAudzAudzekniGrupas", [
            "GrupasNosaukums" => $GrupasNosaukums,
            "LietotajsData" => $LietotajsData,
            "LomasData" => $LomasData,
        ]);
    }
}
