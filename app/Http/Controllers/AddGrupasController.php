<?php

/**
 * Šis kontrolieris nodrošina jaunu grupu pievienošanu baletskolas kostīmu uzskaites sistēmai.
 * Tas satur divas galvenās funkcijas:
 * - IndexAddGrupas(): Parāda formu jaunas grupas pievienošanai.
 * - GrupasDataInsert(): Apstrādā jaunās grupas datus un ievieto tos datubāzē.
 * 
 * GrupasDataInsert funkcija apstrādā ievades datus no pieprasījuma, validē tos un ievieto
 * Grupas_tabula tabulā. Pēc tam tiek atgriezts paziņojums par veiksmīgu vai neveiksmīgu ievietošanu,
 * atkarībā no procesa iznākuma.
 * 
 * Nosaukums: App\Http\Controllers
 * Izmantotie modeļi: Grupas_tabula
 * Izmantotie skati: addGrupas
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grupas_tabula;

class AddGrupasController extends Controller
{
    /**
     * Parāda formu jaunas grupas pievienošanai.
     *
     */
    function IndexAddGrupas()
    {
        return view("addGrupas");
    }

    /**
     * Apstrādā jaunās grupas datus un ievieto tos datubāzē.
     */
    function GrupasDataInsert(Request $request)
    {
        $GrupasNosaukums = $request->input("GrupasNosaukums");
        $Grafiks = $request->input("Grafiks");
        $Filiale = $request->input("Filiale");

        $isGrupasInsertSuccess = Grupas_tabula::insert([
            "GrupasNosaukums" => $request->input("GrupasNosaukums"),
            "Grafiks" => $request->input("Grafiks"),
            "Filiale" => $request->input("Filiale"),
        ]);

        if ($isGrupasInsertSuccess) {
            echo '<script>alert("Jauna grupa veiksmīgi pievienota ;)");</script>';
        } else {
            echo '<script>alert("Jauna grupa netika pievienota :(");</script>';
        }

        return view("addGrupas");
    }
}
