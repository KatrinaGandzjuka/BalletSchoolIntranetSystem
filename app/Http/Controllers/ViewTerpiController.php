<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Terpi_tabula;

/**
 * ViewTerpiController nodrošina funkcijas tērpu datu skatīšanai, rediģēšanai un meklēšanai.
 * 
 * Nosaukums: App\Http\Controllers
 * Izmantotie modeļi: Terpi_tabula
 * Izmantotie skati: viewTerpi, terpiRediget
 */
class ViewTerpiController extends Controller
{
    /**
     * Ģenerē skatu ar tērpu sarakstu.
     */
    function ViewTerpiIndex()
    {
        $TerpiData = Terpi_tabula::all();
        return view("viewTerpi", ["TerpiData" => $TerpiData]);
    }

    /**
     * Ģenerē skatu tērpa datu rediģēšanai.
     */
    function TerpiRedigetIndex($KostimiID)
    {
        $TerpiData = Terpi_tabula::where("KostimiID", $KostimiID)->get();
        if (count($TerpiData) > 0) {
            return view("terpiRediget", ["td" => $TerpiData[0]]);
        } else {
            return view("terpiRediget", ["td" => null]);
        }
    }

    /**
     * Atjaunina tērpa datus.
     */
    function DataUpdateTerpi(Request $request)
    {
        $KostimiID = $request->KostimiID;
        $Nosaukums = $request->input("Nosaukums");
        $Krasa = $request->input("Krasa");
        $Izmers = $request->input("Izmers");
        $Attels = $request->file("Attels");

        if ($Attels) {
            $imageData = file_get_contents($Attels->getRealPath());
            $base64 = base64_encode($imageData);
        } else {
            $base64 = null;
        }

        $isTerpiUpdateSuccess = Terpi_tabula::where("KostimiID", $KostimiID)->update([
            "Nosaukums" => $request->input("Nosaukums"),
            "Krasa" => $request->input("Krasa"),
            "Izmers" => $request->input("Izmers"),
            "Attels" => $base64,
        ]);

        if ($isTerpiUpdateSuccess) {
            echo '<script>alert("Kostīma dati veiksmīgi rediģēti ;)");</script>';
        } else {
            echo '<script>alert("Kostīma dati netika rediģēti :(");</script>';
        }
        
        $TerpiData = Terpi_tabula::all();
        return view("viewTerpi", ["TerpiData" => $TerpiData]);
    }

    /**
     * Meklē tērpus pēc nosaukuma, krāsas vai izmēra.
     */
    function SearchTerpi(Request $request)
    {
        $query = $request->input("query");
        $TerpiData = Terpi_tabula::where("Nosaukums", "LIKE", "%" . $query . "%")
            ->orWhere("Krasa", "LIKE", "%" . $query . "%")
            ->orWhere("Izmers", "LIKE", "%" . $query . "%")
            ->get();
        
        return view("viewTerpi", ["TerpiData" => $TerpiData]);
    }
}
