<?php

/**
 * Šis kontrolieris nodrošina jaunu kostīmu pievienošanu baletskolas kostīmu uzskaites sistēmai.
 * Tas satur divas galvenās funkcijas:
 * - IndexAddTerpi(): Parāda formu jauna kostīma pievienošanai.
 * - TerpiDataInsert(): Apstrādā jaunā kostīma datus un ievieto tos datubāzē.
 * 
 * TerpiDataInsert funkcija apstrādā ievades datus no pieprasījuma, validē tos un ievieto
 * Terpi_tabula tabulā. Ja tiek pievienots attēls, tas tiek konvertēts uz base64 formātu un
 * saglabāts datubāzē. Pēc tam tiek atgriezts paziņojums par veiksmīgu vai neveiksmīgu ievietošanu,
 * atkarībā no procesa iznākuma.
 * 
 * Nosaukums: App\Http\Controllers
 * Izmantotais modelis: Terpi_tabula
 * Izmantotais skats: addTerpi
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Terpi_tabula;

class AddTerpiController extends Controller
{
    /**
     * Parāda formu jauna kostīma pievienošanai.
     *
     * @return \Illuminate\View\View
     */
    function IndexAddTerpi()
    {
        return view("addTerpi");
    }

    /**
     * Apstrādā jaunā kostīma datus un ievieto tos datubāzē.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    function TerpiDataInsert(Request $request)
    {
        $Nosaukums = $request->input("Nosaukums");
        $Krasa = $request->input("Krasa");
        $Izmers = $request->input("Izmers");
        $Attels = $request->file("Attels");

        // Pārbauda vai ir augšupielādēts attēls, un konvertē to base64 formātā
        if ($Attels) {
            $imageData = file_get_contents($Attels->getRealPath());
            $base64 = base64_encode($imageData);
        } else {
            $base64 = null;
        }

        // Ievieto datus Terpi_tabula tabulā
        $isTerpiInsertSuccess = Terpi_tabula::insert([
            "Nosaukums" => $request->input("Nosaukums"),
            "Krasa" => $request->input("Krasa"),
            "Izmers" => $request->input("Izmers"),
            "Attels" => $base64,
        ]);

        // Izvada paziņojumu par ievietošanas rezultātu
        if ($isTerpiInsertSuccess) {
            echo '<script>alert("Jauns kostīms veiksmīgi pievienots ;)");</script>';
        } else {
            echo '<script>alert("Jauns kostīms netika pievienots :(");</script>';
        }

        return view("addTerpi");
    }
}
