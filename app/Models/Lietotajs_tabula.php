<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Lietotajs_tabula modelis nodrošina lietotāja datu pārvaldību.
 * 
 * Nosaukums: App\Models
 * 
 * Parametri:
 * - $personasKods - primārā atslēga
 */
class Lietotajs_tabula extends Model
{
    use HasFactory;

    /**
     * Tabulas nosaukums, kas saistīta ar šo modeli.
     */
    public $table = 'lietotajs';

    /**
     * Primārās atslēgas kolonnas nosaukums.
     */
    public $primaryKey = 'personasKods';

    /**
     * Norāda, vai primārā atslēga ir automātiski pieaugoša.
     */
    public $incrementing = false;

    /**
     * Norāda, vai modelim ir atjaunināšanas un izveides laika zīmogi.
     */
    public $timestamps = false;

    /**
     * Attiecība "daudzi pret daudziem" ar Lietotajs_tabula modeli caur bernsvecaks tabulu.
     */
    public function vecaki()
    {
        return $this->belongsToMany(Lietotajs_tabula::class, 'bernsvecaks', 'BernaPersonasKods', 'VecakaPersonasKods');
    }

    /**
     * Attiecība "daudzi pret daudziem" ar Grupas_tabula modeli caur audzeknisgrupa tabulu.
     */
    public function grupa()
    {
        return $this->belongsToMany(Grupas_tabula::class, 'audzeknisgrupa', 'AudzeknaGrupasPersonasKods', 'GrupasAudzeknaNosaukums');
    }
}
