<?php

/**
 * Šis kontrolieris nodrošina lietotāju autentifikāciju un dažādu lomu vadību baletskolas sistēmā.
 * Tas satur sešas galvenās funkcijas:
 * - LoginIndex(): Parāda pieteikšanās lapu.
 * - LoginPost(): Apstrādā lietotāja pieteikšanās datus un pārbauda, vai tie ir pareizi.
 * - AudzeknisIndex(): Parāda audzēkņa informācijas lapu, ieskaitot grupas, pedagogus, tērpus, vecākus, koncertus un numurus.
 * - VecaksIndex(): Parāda vecāka informācijas lapu, ieskaitot bērna datus.
 * - PedagogsIndex(): Parāda pedagoga informācijas lapu, ieskaitot grupas, audzēkņus, vecākus, tērpus un koncertus.
 * 
 * Nosaukums: App\Http\Controllers
 * Izmantotie modeļi: Lietotajs_tabula, Grupas_tabula, AudzeknisGrupa_tabula, Terpi_tabula, BernsVecaks_tabula, Koncerts_tabula, Numurs_tabula, AudzeknisNumurs_tabula, PedagogsNumurs_tabula, KoncertsNumurs_tabula
 * Izmantotie skati: login, admin, audzeknis, vecaks, pedagogs
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lietotajs_tabula;
use App\Models\Grupas_tabula;
use App\Models\AudzeknisGrupa_tabula;
use App\Models\Terpi_tabula;
use App\Models\BernsVecaks_tabula;
use App\Models\Koncerts_tabula;
use App\Models\Numurs_tabula;
use App\Models\AudzeknisNumurs_tabula;
use App\Models\PedagogsNumurs_tabula;
use App\Models\KoncertsNumurs_tabula;

class LoginController extends Controller
{
    /**
     * Parāda pieteikšanās lapu.
     */
    function LoginIndex()
    {
        return view("login");
    }

    /**
     * Apstrādā lietotāja pieteikšanās datus un pārbauda, vai tie ir pareizi.
     */
    function LoginPost(Request $request)
    {
        $personasKods = $request->input("personasKods");
        $parole = $request->input("Parole");

        $lietotajs = Lietotajs_tabula::where("personasKods", $personasKods)
            ->where("parole", $parole)
            ->first();

        if ($lietotajs) {
            session([
                "personasKods" => $personasKods,
                "LomaID" => $lietotajs->LomaID,
            ]);
            echo '<script>alert(" ;) ");</script>';
            switch (session("LomaID")) {
                case 0:
                    return view("admin");
                    break;
                case 1:
                    return $this->AudzeknisIndex($personasKods);
                    break;
                case 2:
                    return $this->VecaksIndex($personasKods);
                    break;
                case 3:
                    return $this->PedagogsIndex($personasKods);
                    break;
            }
        } else {
            echo '<script>alert(" :( Pārbaudiet personas kodu un paroli");</script>';
            return view("login");
        }
    }

    /**
     * Parāda audzēkņa informācijas lapu, ieskaitot grupas, pedagogus, tērpus, vecākus, koncertus un numurus.
     */
    function AudzeknisIndex($personasKods)
    {
        $LietotajsData = Lietotajs_tabula::where("personasKods", $personasKods)->first();

        $GrupasData = Grupas_tabula::join("audzeknisgrupa", "grupa.GrupasNosaukums", "=", "audzeknisgrupa.GrupasAudzeknaNosaukums")
            ->join("filiale", "grupa.Filiale", "=", "filiale.Filiale")
            ->where("audzeknisgrupa.AudzeknaGrupasPersonasKods", $personasKods)
            ->select("grupa.*", "filiale.Valsts", "filiale.Pilseta", "filiale.Rajons", "filiale.Iela", "filiale.Eka", "filiale.Indekss")
            ->distinct()
            ->get();

        $PedagogsData = Lietotajs_tabula::where("LomaID", 3)
            ->where(function ($query) use ($GrupasData) {
                foreach ($GrupasData as $grupa) {
                    $GrupasNosaukums = $grupa->GrupasNosaukums;
                    $query->orWhereExists(function ($subquery) use ($GrupasNosaukums) {
                        $subquery
                            ->select("*")
                            ->from("pedagogsgrupa")
                            ->whereRaw("PedagogaPersonasKods = personasKods")
                            ->where("GrupasPedagogaNosaukums", $GrupasNosaukums);
                    });
                }
            })
            ->get();

        $TerpiData = Terpi_tabula::join("audzeknikostimi", "kostimi.KostimiID", "=", "audzeknikostimi.KostimiID")
            ->where("audzeknikostimi.AudzeknaKostimaPersonasKods", $personasKods)
            ->select("kostimi.*", "audzeknikostimi.PiesDatums")
            ->get();

        $VecaksData = BernsVecaks_tabula::join("lietotajs", "bernsvecaks.VecakaPersonasKods", "=", "lietotajs.personasKods")
            ->where("bernsvecaks.BernaPersonasKods", $personasKods)
            ->get(["lietotajs.Vards", "lietotajs.Uzvards", "lietotajs.personasKods", "lietotajs.Talrunis", "lietotajs.Epasts", "lietotajs.DzimDiena"]);

        $KoncertiData = Koncerts_tabula::join('koncertsnumurs', 'koncerts.KoncertsID', '=', 'koncertsnumurs.KoncertsIDKoncNumurs')
            ->join('audzeknisnumurs', 'koncertsnumurs.NumursIDKoncNumurs', '=', 'audzeknisnumurs.NumursIDAudzeknis')
            ->where('audzeknisnumurs.AudzeknaNumuraPersonasKods', $personasKods)
            ->select('koncerts.*')
            ->distinct()
            ->get();

        $NumuriData = Numurs_tabula::join('audzeknisnumurs', 'numurs.NumursID', '=', 'audzeknisnumurs.NumursIDAudzeknis')
            ->join('koncertsnumurs', 'numurs.NumursID', '=', 'koncertsnumurs.NumursIDKoncNumurs')
            ->join('kostimi', 'numurs.KostimiIDnumurs', '=', 'kostimi.KostimiID')
            ->where('audzeknisnumurs.AudzeknaNumuraPersonasKods', $personasKods)
            ->select('numurs.*', 'koncertsnumurs.KartasNumurs', 'koncertsnumurs.KoncertsIDKoncNumurs', 'kostimi.Nosaukums as KostimaNosaukums')
            ->get();

        return view("audzeknis", [
            "ld" => $LietotajsData,
            "GrupasData" => $GrupasData,
            "PedagogsData" => $PedagogsData,
            "TerpiData" => $TerpiData,
            "VecaksData" => $VecaksData,
            "KoncertiData" => $KoncertiData,
            "NumuriData" => $NumuriData,
        ]);
    }

    /**
     * Parāda vecāka informācijas lapu, ieskaitot bērna datus.
     */
    function VecaksIndex($personasKods)
    {
        $LietotajsData = Lietotajs_tabula::where(
            "personasKods",
            $personasKods
        )->get();

        $BernsData = BernsVecaks_tabula::join(
            "lietotajs",
            "bernsvecaks.BernaPersonasKods",
            "=",
            "lietotajs.personasKods"
        )
            ->where("bernsvecaks.VecakaPersonasKods", $personasKods)
            ->get([
                "lietotajs.Vards",
                "lietotajs.Uzvards",
                "lietotajs.personasKods",
                "lietotajs.Talrunis",
                "lietotajs.Epasts",
                "lietotajs.DzimDiena",
            ]);

        if (count($LietotajsData) > 0) {
            return view("vecaks", [
                "ld" => $LietotajsData[0],
                "BernsData" => $BernsData,
            ]);
        } else {
            return view("vecaks", ["ld" => null]);
        }
    }

    /**
     * Parāda pedagoga informācijas lapu, ieskaitot grupas, audzēkņus, vecākus, tērpus un koncertus.
     */
    public function PedagogsIndex($personasKods)
    {
        $LietotajsData = Lietotajs_tabula::where('personasKods', $personasKods)->first();

        $GrupasData = Grupas_tabula::join('pedagogsgrupa', 'grupa.GrupasNosaukums', '=', 'pedagogsgrupa.GrupasPedagogaNosaukums')
            ->join('filiale', 'grupa.Filiale', '=', 'filiale.Filiale')
            ->where('pedagogsgrupa.PedagogaPersonasKods', $personasKods)
            ->select('grupa.*', 'filiale.Valsts', 'filiale.Pilseta', 'filiale.Rajons', 'filiale.Iela', 'filiale.Eka', 'filiale.Indekss', 'pedagogsgrupa.*')
            ->distinct()
            ->get();

        $AudzeknisData = Lietotajs_tabula::where('LomaID', 1)
            ->whereIn('personasKods', function($query) use ($GrupasData) {
                $query->select('AudzeknaGrupasPersonasKods')
                      ->from('audzeknisgrupa')
                      ->whereIn('GrupasAudzeknaNosaukums', $GrupasData->pluck('GrupasNosaukums'));
            })
            ->get();

        $VecakiData = BernsVecaks_tabula::join('lietotajs as vecaki', 'bernsvecaks.VecakaPersonasKods', '=', 'vecaki.personasKods')
            ->join('lietotajs as berni', 'bernsvecaks.BernaPersonasKods', '=', 'berni.personasKods')
            ->whereIn('berni.personasKods', $AudzeknisData->pluck('personasKods'))
            ->get(['berni.Vards as BernsVards', 'berni.Uzvards as BernsUzvards', 'berni.personasKods as BernsPersonasKods', 'vecaki.Vards as VecaksVards', 'vecaki.Uzvards as VecaksUzvards', 'vecaki.Talrunis as VecaksTalrunis']);

        $TerpiData = Terpi_tabula::all();

        $KoncertiData = Koncerts_tabula::all();

        $KoncertiNumuri = KoncertsNumurs_tabula::with(['numurs', 'koncerts', 'numurs.audzekni', 'numurs.pedagogi'])
            ->whereHas('numurs.pedagogi', function($query) use ($personasKods) {
                $query->where('PedagogaNumuraPersonasKods', $personasKods);
            })
            ->get();
        
        $nodarbibuSkaits = $GrupasData->sum('NodSk');
        $grupuSkaits = $GrupasData->count();

        return view('pedagogs', compact('LietotajsData', 'GrupasData', 'AudzeknisData', 'VecakiData', 'TerpiData', 'KoncertiData', 'KoncertiNumuri', 'nodarbibuSkaits', 'grupuSkaits'));
    }
}
