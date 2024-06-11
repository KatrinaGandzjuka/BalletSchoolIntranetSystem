<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lietotajs_tabula;
use App\Models\Lomas_tabula;
use App\Models\BernsVecaks_tabula;

/**
 * ViewLietotajiController nodrošina funkcijas lietotāju datu skatīšanai un rediģēšanai.
 * Tas ietver metodes lietotāju saraksta skatīšanai, lietotāju datu rediģēšanai un lietotāju datu atjaunināšanai.
 * 
 * Nosaukums: App\Http\Controllers
 * Izmantotie modeļi: Lietotajs_tabula, Lomas_tabula, BernsVecaks_tabula
 * Izmantotie skati: viewLietotaji, lietotajiRediget
 */
class ViewLietotajiController extends Controller
{
    /**
     * Ģenerē skatu ar lietotāju sarakstu atkarībā no lomas.
     */
    function ViewLietotajiIndex(Request $request)
    {
        $loma = $request->input("loma");
        $LietotajsData = null;
        $LomasData = Lomas_tabula::all();

        if ($loma == 1) {
            $LietotajsData = Lietotajs_tabula::where("LomaID", 1)->get();
        } elseif ($loma == 2) {
            $LietotajsData = Lietotajs_tabula::where("LomaID", 2)->get();
        } elseif ($loma == 3) {
            $LietotajsData = Lietotajs_tabula::where("LomaID", 3)->get();
        } else {
            $LietotajsData = Lietotajs_tabula::whereIn("LomaID", [1, 2, 3])->get();
        }

        return view("viewLietotaji", compact("LietotajsData", "LomasData"));
    }

    /**
     * Ģenerē skatu lietotāja datu rediģēšanai.
     */
    function LietotajiRedigetIndex($personasKods)
    {
        $LietotajsData = Lietotajs_tabula::where("personasKods", $personasKods)->get();
        if (count($LietotajsData) > 0) {
            return view("lietotajiRediget", ["ld" => $LietotajsData[0]]);
        } else {
            return view("lietotajiRediget", ["ld" => null]);
        }
    }

    /**
     * Atjaunina lietotāja datus.
     */
    public function DataUpdateLietotaji(Request $request)
    {
        $personasKods = $request->personasKods;
        $Vards = $request->input("Vards");
        $Uzvards = $request->input("Uzvards");
        $Epasts = $request->input("Epasts");
        $Parole = $request->input("Parole");
        $Talrunis = $request->input("Talrunis");

        $isLietotajiUpdateSuccess = Lietotajs_tabula::where("personasKods", $personasKods)->update([
            "Vards" => $request->input("Vards"),
            "Uzvards" => $request->input("Uzvards"),
            "Epasts" => $request->input("Epasts"),
            "Parole" => $request->input("Parole"),
            "Talrunis" => $request->input("Talrunis"),
        ]);

        if ($isLietotajiUpdateSuccess) {
            if ($request->has("bernaPersonasKods")) {
                $newEntry = new BernsVecaks_tabula();
                $newEntry->BernaPersonasKods = $request->input("bernaPersonasKods");
                $newEntry->VecakaPersonasKods = $personasKods;
                $isBernaVecaksInsertSuccess = $newEntry->save();
                if ($isBernaVecaksInsertSuccess) {
                    return back()->with(["success" => true]);
                }
            } else {
                return back()->with(["success" => true]);
            }
        }
        return back()->with(["success" => true]);
    }
}
