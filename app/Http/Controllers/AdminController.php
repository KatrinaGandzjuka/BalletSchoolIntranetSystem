<?php

/**
 * Šis kontrolieris nodrošina lietotāju pievienošanu un administrēšanu baletskolas sistēmā.
 * Tas satur divas galvenās funkcijas:
 * - AdminIndex(): Parāda administrācijas sākumlapu.
 * - UserDataInsert(): Apstrādā jaunā lietotāja datus un ievieto tos datubāzē.
 * 
 * UserDataInsert funkcija apstrādā ievades datus no pieprasījuma, validē tos un ievieto
 * Lietotajs_tabula tabulā. Pēc tam tiek atgriezts paziņojums par veiksmīgu vai neveiksmīgu ievietošanu,
 * atkarībā no procesa iznākuma.
 * 
 * Nosaukums: App\Http\Controllers
 * Izmantotais modelis: Lietotajs_tabula
 * Izmantotais skats: admin
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lietotajs_tabula;

class AdminController extends Controller
{
    /**
     * Parāda administrācijas sākumlapu.
     *
     * @return \Illuminate\View\View
     */
    function AdminIndex()
    {
        return view("admin");
    }

    /**
     * Apstrādā jaunā lietotāja datus un ievieto tos datubāzē.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    function UserDataInsert(Request $request)
    {
        $personasKods = $request->input("personasKods");
        $Vards = $request->input("Vards");
        $Uzvards = $request->input("Uzvards");
        $Epasts = $request->input("Epasts");
        $Parole = $request->input("Parole");
        $Talrunis = $request->input("Talrunis");
        $dzimDiena = $request->input("dzimDiena");
        $LomaID = $request->input("LomaID");

        // Ievieto datus Lietotajs_tabula tabulā
        $isInsertSuccess = Lietotajs_tabula::insert([
            "personasKods" => $request->input("personasKods"),
            "Vards" => $request->input("Vards"),
            "Uzvards" => $request->input("Uzvards"),
            "Epasts" => $request->input("Epasts"),
            "Parole" => $request->input("Parole"),
            "Talrunis" => $request->input("Talrunis"),
            "dzimDiena" => $request->input("dzimDiena"),
            "LomaID" => $request->input("LomaID"),
        ]);

        // Izvada paziņojumu par ievietošanas rezultātu
        if ($isInsertSuccess) {
            echo '<script>alert("Jauns lietotājs veiksmīgi pievienots ;)");</script>';
        } else {
            echo '<script>alert("Jauns lietotājs netika pievienots :(");</script>';
        }
        return view("admin");
    }
}
