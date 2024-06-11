<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Grupas_tabula;

/**
 * ViewGrupasController nodrošina funkcijas grupu datu skatīšanai un rediģēšanai.
 * Tas ietver metodes visu grupu datu skatīšanai, grupu datu rediģēšanai un grupu datu atjaunināšanai.
 * 
 * Nosaukums: App\Http\Controllers
 * Izmantotie modeļi: Grupas_tabula
 * Izmantotie skati: viewGrupas, grupasRediget
 */
class ViewGrupasController extends Controller
{
    /**
     * Ģenerē skatu ar visu grupu sarakstu.
     */
    function ViewGrupasIndex()
    {
        $GrupasData = Grupas_tabula::all();
        foreach ($GrupasData as $key => $gd) {
            $audzeknuSkaits = DB::table("audzeknisgrupa")
                ->join(
                    "grupa",
                    "audzeknisgrupa.GrupasAudzeknaNosaukums",
                    "=",
                    "grupa.GrupasNosaukums"
                )
                ->where("grupa.GrupasNosaukums", "=", $gd->GrupasNosaukums)
                ->count();
            $GrupasData[$key]->audzeknuSkaits = $audzeknuSkaits;
        }
        return view("viewGrupas", ["GrupasData" => $GrupasData]);
    }

    /**
     * Ģenerē skatu grupas datu rediģēšanai.
     */
    function GrupasRedigetIndex($GrupasNosaukums)
    {
        $GrupasData = Grupas_tabula::where(
            "GrupasNosaukums",
            $GrupasNosaukums
        )->get();
        if (count($GrupasData) > 0) {
            return view("grupasRediget", ["gd" => $GrupasData[0]]);
        } else {
            return view("grupasRediget", ["gd" => null]);
        }
    }

    /**
     * Atjaunina grupas datus.
     */
    function DataUpdateGrupas(Request $request)
    {
        $GrupasNosaukums = $request->GrupasNosaukums;
        $Grafiks = $request->input("Grafiks");
        $Filiale = $request->input("Filiale");

        $isUpdateSuccess = Grupas_tabula::where(
            "GrupasNosaukums",
            $GrupasNosaukums
        )->update([
            "Grafiks" => $request->input("Grafiks"),
            "Filiale" => $request->input("Filiale"),
        ]);

        if ($isUpdateSuccess) {
            echo '<script>alert("Grupas dati veiksmīgi rediģēti ;)");</script>';
        } else {
            echo '<script>alert("Grupas dati netika rediģēti :(");</script>';
        }
        $GrupasData = Grupas_tabula::all();
        return view("viewGrupas", ["GrupasData" => $GrupasData]);
    }
}
