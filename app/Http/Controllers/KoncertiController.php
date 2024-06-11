<?php

/**
 * Šis kontrolieris nodrošina koncertu pārvaldību baletskolas sistēmā.
 * Tas satur sešas galvenās funkcijas:
 * - KoncertiIndex(): Parāda visus koncertus.
 * - AddKoncertsIndex(): Parāda lapu jauna koncerta pievienošanai.
 * - KoncertsDataInsert(): Pievieno jaunu koncertu datubāzei.
 * - EditKoncertsIndex(): Parāda lapu koncerta rediģēšanai.
 * - KoncertsDataUpdate(): Atjaunina esoša koncerta datus.
 * - DeleteKoncertsIndex(): Parāda lapu koncerta dzēšanai.
 * - KoncertsDataDelete(): Dzēš norādīto koncertu un atjauno koncertu sarakstu.
 * 
 * Nosaukums: App\Http\Controllers
 * Izmantotie modeļi: Koncerts_tabula
 * Izmantotie skati: viewKoncerti, addKoncerts, editKoncerts, deleteKoncerts
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Koncerts_tabula;

class KoncertiController extends Controller
{
    /**
     * Parāda visus koncertus.
     *
     * @return \Illuminate\View\View
     */
    public function KoncertiIndex()
    {
        $KoncertiData = Koncerts_tabula::all();
        return view('viewKoncerti', ['KoncertiData' => $KoncertiData]);
    }

    /**
     * Parāda lapu jauna koncerta pievienošanai.
     *
     * @return \Illuminate\View\View
     */
    public function AddKoncertsIndex()
    {
        return view('addKoncerts');
    }

    /**
     * Pievieno jaunu koncertu datubāzei.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function KoncertsDataInsert(Request $request)
    {
        $koncerts = new Koncerts_tabula();
        $koncerts->Nosaukums = $request->input('Nosaukums');
        $koncerts->Datums = $request->input('Datums');
        $koncerts->Vieta = $request->input('Vieta');
        $koncerts->Saite = $request->input('Saite');
        $koncerts->Ilgums = $request->input('Ilgums');
        $koncerts->save();

        return redirect('/koncerti')->with('success', 'Koncerts veiksmīgi pievienots');
    }

    /**
     * Parāda lapu koncerta rediģēšanai.
     *
     * @param int $KoncertsID
     * @return \Illuminate\View\View
     */
    public function EditKoncertsIndex($KoncertsID)
    {
        $koncerts = Koncerts_tabula::find($KoncertsID);
        return view('editKoncerts', ['koncerts' => $koncerts]);
    }

    /**
     * Atjaunina esoša koncerta datus.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $KoncertsID
     * @return \Illuminate\Http\RedirectResponse
     */
    public function KoncertsDataUpdate(Request $request, $KoncertsID)
    {
        $koncerts = Koncerts_tabula::find($KoncertsID);
        $koncerts->Nosaukums = $request->input('Nosaukums');
        $koncerts->Datums = $request->input('Datums');
        $koncerts->Vieta = $request->input('Vieta');
        $koncerts->Saite = $request->input('Saite');
        $koncerts->Ilgums = $request->input('Ilgums');
        $koncerts->save();

        return redirect('/koncerti')->with('success', 'Koncerts veiksmīgi atjaunināts');
    }

    /**
     * Parāda lapu koncerta dzēšanai.
     *
     * @param int $KoncertsID
     * @return \Illuminate\View\View
     */
    public function DeleteKoncertsIndex($KoncertsID)
    {
        $koncerts = Koncerts_tabula::find($KoncertsID);
        return view('deleteKoncerts', ['koncerts' => $koncerts]);
    }

    /**
     * Dzēš norādīto koncertu un atjauno koncertu sarakstu.
     *
     * @param int $KoncertsID
     * @return \Illuminate\Http\RedirectResponse
     */
    public function KoncertsDataDelete($KoncertsID)
    {
        $koncerts = Koncerts_tabula::find($KoncertsID);
        $koncerts->delete();

        return redirect('/koncerti')->with('success', 'Koncerts veiksmīgi izdzēsts');
    }
}
