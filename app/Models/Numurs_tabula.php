<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Numurs_tabula modelis nodrošina numura datu pārvaldību.
 * 
 * Nosaukums: App\Models
 * 
 * Parametri:
 * - $NumursID - primārā atslēga
 */
class Numurs_tabula extends Model
{
    use HasFactory;

    /**
     * Tabulas nosaukums, kas saistīta ar šo modeli.
     */
    public $table = 'numurs';

    /**
     * Primārās atslēgas kolonnas nosaukums.
     */
    public $primaryKey = 'NumursID';

    /**
     * Norāda, vai primārā atslēga ir automātiski pieaugoša.
     */
    public $incrementing = false;

    /**
     * Norāda, vai modelim ir atjaunināšanas un izveides laika zīmogi.
     */
    public $timestamps = false;

    /**
     * Nodrošina saistību ar kostīmu tabulu.
     */
    public function kostims()
    {
        return $this->belongsTo(Terpi_tabula::class, 'KostimiIDnumurs', 'KostimiID');
    }

    /**
     * Nodrošina daudzu-daudziem saistību ar audzēkņu tabulu.
     */
    public function audzekni()
    {
        return $this->belongsToMany(Lietotajs_tabula::class, 'audzeknisnumurs', 'NumursIDAudzeknis', 'AudzeknaNumuraPersonasKods');
    }

    /**
     * Nodrošina daudzu-daudziem saistību ar pedagogu tabulu.
     */
    public function pedagogi()
    {
        return $this->belongsToMany(Lietotajs_tabula::class, 'pedagogsnumurs', 'NumursIDPedagogs', 'PedagogaNumuraPersonasKods');
    }
}
