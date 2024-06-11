<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Koncerts_tabula modelis nodrošina koncerta datu pārvaldību.
 * 
 * Nosaukums: App\Models
 * 
 * Parametri:
 * - $KoncertsID - primārā atslēga
 */
class Koncerts_tabula extends Model
{
    use HasFactory;

    /**
     * Tabulas nosaukums, kas saistīta ar šo modeli.
     */
    public $table = 'koncerts';

    /**
     * Primārās atslēgas kolonnas nosaukums.
     */
    public $primaryKey = 'KoncertsID';

    /**
     * Norāda, vai primārā atslēga ir automātiski pieaugoša.
     */
    public $incrementing = true;

    /**
     * Norāda, vai modelim ir atjaunināšanas un izveides laika zīmogi.
     */
    public $timestamps = false;

    /**
     * Attiecība "viens pret daudziem" ar KoncertsNumurs_tabula modeli.
     */
    public function numuri()
    {
        return $this->hasMany(KoncertsNumurs_tabula::class, 'KoncertsIDKoncNumurs', 'KoncertsID');
    }
}
