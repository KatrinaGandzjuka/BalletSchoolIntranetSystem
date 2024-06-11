<?php

/**
 * PDFController nodrošina PDF dokumentu ģenerēšanu dažādiem sistēmas datiem, izmantojot DomPDF bibliotēku.
 * Tas ietver metodes grupu, tērpu un koncerta datu eksportēšanai uz PDF formātu.
 * 
 * Nosaukums: App\Http\Controllers
 * Izmantotie modeļi: Koncerts_tabula, KoncertsNumurs_tabula, Numurs_tabula, AudzeknisNumurs_tabula, PedagogsNumurs_tabula, Lietotajs_tabula, Grupas_tabula, Terpi_tabula
 * Izmantotie skati: pdf.grupas_saraksts, pdf.terpi_saraksts, pdf.koncerts_saraksts, pdf.koncerts_kostimi_saraksts, pdf.pedagogs_terpi, pdf.pedagogs_numuri, pdf.audzeknis_kostimi_saraksts
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\PDF;
use App\Models\Koncerts_tabula;
use App\Models\KoncertsNumurs_tabula;
use App\Models\Numurs_tabula;
use App\Models\AudzeknisNumurs_tabula;
use App\Models\PedagogsNumurs_tabula;
use App\Models\Lietotajs_tabula;
use App\Models\Grupas_tabula;
use App\Models\Terpi_tabula;

class PDFController extends Controller
{
    /**
     * Ģenerē PDF failu ar grupas sarakstu.
     */
    public function generateGrupasPDF($GrupasNosaukums)
    {
        $grupa = Grupas_tabula::where('GrupasNosaukums', $GrupasNosaukums)->first();
        
        $audzekni = Lietotajs_tabula::whereIn('LomaID', [1])
            ->whereExists(function ($query) use ($GrupasNosaukums) {
                $query->select('*')
                      ->from('audzeknisgrupa')
                      ->whereRaw('AudzeknaGrupasPersonasKods = personasKods')
                      ->where('GrupasAudzeknaNosaukums', $GrupasNosaukums);
            })
            ->with('vecaki')
            ->get();

        $pedagogs = Lietotajs_tabula::whereIn('LomaID', [3])
            ->whereExists(function ($query) use ($GrupasNosaukums) {
                $query->select('*')
                      ->from('pedagogsgrupa')
                      ->whereRaw('PedagogaPersonasKods = personasKods')
                      ->where('GrupasPedagogaNosaukums', $GrupasNosaukums);
            })
            ->first();

        $data = [
            'grupa' => $grupa,
            'audzekni' => $audzekni,
            'pedagogs' => $pedagogs
        ];

        $pdf = PDF::loadView('pdf.grupas_saraksts', $data);
        return $pdf->download('grupas_saraksts_'.$GrupasNosaukums.'.pdf');
    }

    /**
     * Ģenerē PDF failu ar visu tērpu sarakstu.
     */
    public function generateTerpiPDF()
    {
        $terpi = Terpi_tabula::all();
        $terpiCount = $terpi->count();

        $data = [
            'terpi' => $terpi,
            'terpiCount' => $terpiCount
        ];

        $pdf = PDF::loadView('pdf.terpi_saraksts', $data);
        return $pdf->download('terpi_saraksts.pdf');
    }

    /**
     * Ģenerē PDF failu ar konkrēta koncerta sarakstu.
     */
    public function generateKoncertsPDF($KoncertsID)
    {
        $koncerts = Koncerts_tabula::find($KoncertsID);
        $numuri = KoncertsNumurs_tabula::where('KoncertsIDKoncNumurs', $KoncertsID)
            ->orderBy('KartasNumurs')
            ->get();

        foreach ($numuri as $numurs) {
            $numurs->audzekni = AudzeknisNumurs_tabula::where('NumursIDAudzeknis', $numurs->NumursIDKoncNumurs)
                ->join('lietotajs', 'audzeknisnumurs.AudzeknaNumuraPersonasKods', '=', 'lietotajs.personasKods')
                ->leftJoin('audzeknisgrupa', 'audzeknisnumurs.AudzeknaNumuraPersonasKods', '=', 'audzeknisgrupa.AudzeknaGrupasPersonasKods')
                ->leftJoin('grupa', 'audzeknisgrupa.GrupasAudzeknaNosaukums', '=', 'grupa.GrupasNosaukums')
                ->select('lietotajs.Vards', 'lietotajs.Uzvards', 'grupa.GrupasNosaukums')
                ->get();
                
            $numurs->pedagogi = PedagogsNumurs_tabula::where('NumursIDPedagogs', $numurs->NumursIDKoncNumurs)
                ->join('lietotajs', 'pedagogsnumurs.PedagogaNumuraPersonasKods', '=', 'lietotajs.personasKods')
                ->select('lietotajs.Vards', 'lietotajs.Uzvards')
                ->get();
        }

        $data = [
            'koncerts' => $koncerts,
            'numuri' => $numuri
        ];

        $pdf = PDF::loadView('pdf.koncerts_saraksts', $data);
        return $pdf->download('koncerts_saraksts_'.$koncerts->Nosaukums.'.pdf');
    }

    /**
     * Eksportē PDF failu ar konkrēta koncerta kostīmu sarakstu.
     */
    public function exportKoncertsKostimiPDF($koncertsID)
    {
        $koncerts = Koncerts_tabula::findOrFail($koncertsID);
        $numuri = KoncertsNumurs_tabula::where('KoncertsIDKoncNumurs', $koncertsID)->get();

        foreach ($numuri as $numurs) {
            $numurs->numurs = Numurs_tabula::with('kostims')->find($numurs->NumursIDKoncNumurs);
        }

        $data = [
            'koncerts' => $koncerts,
            'numuri' => $numuri
        ];

        $pdf = PDF::loadView('pdf.koncerts_kostimi_saraksts', $data);
        return $pdf->download('koncerts_kostimi_saraksts_'.$koncerts->Nosaukums.'.pdf');
    }

    /**
     * Eksportē PDF failu ar pedagoga tērpu sarakstu konkrētam koncertam.
     */
    public function exportPedagogsTerpiPDF($personasKods, $koncertsID)
    {
        $pedagogs = Lietotajs_tabula::where('personasKods', $personasKods)->first();
        $koncerts = Koncerts_tabula::findOrFail($koncertsID);

        $numuri = KoncertsNumurs_tabula::where('KoncertsIDKoncNumurs', $koncertsID)
            ->whereHas('numurs.pedagogi', function($query) use ($personasKods) {
                $query->where('PedagogaNumuraPersonasKods', $personasKods);
            })
            ->with('numurs.kostims')
            ->get();

        $data = [
            'pedagogs' => $pedagogs,
            'koncerts' => $koncerts,
            'numuri' => $numuri
        ];

        $pdf = PDF::loadView('pdf.pedagogs_terpi', $data);
        return $pdf->download('pedagogs_terpi_'.$pedagogs->Vards.''.$pedagogs->Uzvards.'.pdf');
    }

    /**
     * Eksportē PDF failu ar pedagoga numuru sarakstu konkrētam koncertam.
     */
    public function exportPedagogsNumuriPDF($personasKods, $koncertsID)
    {
        $pedagogs = Lietotajs_tabula::where('personasKods', $personasKods)->first();
        $koncerts = Koncerts_tabula::findOrFail($koncertsID);

        $numuri = KoncertsNumurs_tabula::where('KoncertsIDKoncNumurs', $koncertsID)
            ->whereHas('numurs.pedagogi', function($query) use ($personasKods) {
                $query->where('PedagogaNumuraPersonasKods', $personasKods);
            })
            ->orderBy('KartasNumurs')
            ->with(['numurs', 'numurs.audzekni'])
            ->get();

        $data = [
            'pedagogs' => $pedagogs,
            'koncerts' => $koncerts,
            'numuri' => $numuri
        ];

        $pdf = PDF::loadView('pdf.pedagogs_numuri', $data);
        return $pdf->download('pedagogs_numuri_'.$pedagogs->Vards.''.$pedagogs->Uzvards.'.pdf');
    }

    /**
     * Eksportē PDF failu ar audzēkņa tērpu sarakstu konkrētam koncertam.
     */
    public function exportAudzeknisTerpiPDF($personasKods, $koncertsID)
    {
        $audzeknis = Lietotajs_tabula::where('personasKods', $personasKods)->first();
        $koncerts = Koncerts_tabula::findOrFail($koncertsID);
        $numuri = KoncertsNumurs_tabula::where('KoncertsIDKoncNumurs', $koncertsID)
            ->whereHas('numurs.audzekni', function($query) use ($personasKods) {
                $query->where('AudzeknaNumuraPersonasKods', $personasKods);
            })
            ->get();

        foreach ($numuri as $numurs) {
            $numurs->numurs = Numurs_tabula::with('kostims')->find($numurs->NumursIDKoncNumurs);
        }

        $data = [
            'audzeknis' => $audzeknis,
            'koncerts' => $koncerts,
            'numuri' => $numuri
        ];

        $pdf = PDF::loadView('pdf.audzeknis_kostimi_saraksts', $data);
        return $pdf->download('audzeknis_kostimi_saraksts_'.$audzeknis->Vards.''.$audzeknis->Uzvards.'.pdf');
    }
}
