<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Grupas_tabula modelis nodrošina grupas datu pārvaldību.
 * 
 * Nosaukums: App\Models
 * 
 * Parametri:
 * - $GrupasNosaukums - primārā atslēga
 */
class Grupas_tabula extends Model
{
    use HasFactory;

    /**
     * Tabulas nosaukums, kas saistīta ar šo modeli.
     */
    public $table = 'grupa';

    /**
     * Primārās atslēgas kolonnas nosaukums.
     */
    public $primaryKey = 'GrupasNosaukums';

    /**
     * Norāda, vai primārā atslēga ir automātiski pieaugoša.
     */
    public $incrementing = false;

    /**
     * Norāda, vai modelim ir atjaunināšanas un izveides laika zīmogi.
     */
    public $timestamps = false;
}
