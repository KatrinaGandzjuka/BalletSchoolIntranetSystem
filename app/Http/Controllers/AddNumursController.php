<?php

/**
 * Šis kontrolieris nodrošina jaunu numuru pievienošanu baletskolas kostīmu uzskaites sistēmai.
 * Tas satur divas galvenās funkcijas:
 * - IndexAddNumurs(): Parāda formu jauna numura pievienošanai un nodrošina pieejamos kostīmus.
 * - NumursDataInsert(): Apstrādā jaunā numura datus un ievieto tos datubāzē.
 * 
 * NumursDataInsert funkcija apstrādā ievades datus no pieprasījuma, validē tos un ievieto
 * Numurs_tabula tabulā. Pēc tam tiek atgriezts paziņojums par veiksmīgu vai neveiksmīgu ievietošanu,
 * atkarībā no procesa iznākuma.
 * 
 * Nosaukums: App\Http\Controllers
 * Izmantotie modeļi: Numurs_tabula, Terpi_tabula
 * Izmantotie skati: addNumurs
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Numurs_tabula;
use App\Models\Terpi_tabula;

class AddNumursController extends Controller
{
    /**
     * Parāda formu jauna numura pievienošanai un nodrošina pieejamos kostīmus.
     *
     * @return \Illuminate\View\View
     */
    function IndexAddNumurs()
    {
        $KostimiData = Terpi_tabula::all();
        return view('addNumurs', ['KostimiData' => $KostimiData]);
    }

    /**
     * Apstrādā jaunā numura datus un ievieto tos datubāzē.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    function NumursDataInsert(Request $request)
    {
        $NumuraNosaukums = $request->input("NumuraNosaukums");
        $Garums = $request->input("Garums");
        $Muzika = $request->input("Muzika");
        $Horeografija = $request->input("Horeografija");
        $IzpilditajuSkaits = $request->input("IzpilditajuSkaits");
        $KostimiIDnumurs = $request->input("KostimiIDnumurs");

        $isNumursInsertSuccess = Numurs_tabula::insert([
            "NumuraNosaukums" => $request->input("NumuraNosaukums"),
            "Garums" => $request->input("Garums"),
            "Muzika" => $request->input("Muzika"),
            "Horeografija" => $request->input("Horeografija"),
            "IzpilditajuSkaits" => $request->input("IzpilditajuSkaits"),
            "KostimiIDnumurs" => $request->input("KostimiIDnumurs"),
        ]);

        if ($isNumursInsertSuccess) {
            echo '<script>alert("Jauns numurs veiksmīgi pievienots ;)");</script>';
        } else {
            echo '<script>alert("Jauns numurs netika pievienots :(");</script>';
        }

        $KostimiData = Terpi_tabula::all();
        return view('addNumurs', ['KostimiData' => $KostimiData]);
    }
}
