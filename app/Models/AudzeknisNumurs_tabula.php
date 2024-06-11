<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * AudzeknisNumurs_tabula modelis nodrošina audzēkņu un numuru attiecību datu pārvaldību.
 * 
 * Nosaukums: App\Models
 * 
 * Parametri:
 * - $AudzeknisNumursID - primārā atslēga
 */
class AudzeknisNumurs_tabula extends Model
{
    use HasFactory;
    
    /**
     * Tabulas nosaukums, kas saistīta ar šo modeli.
     */
    public $table = 'audzeknisnumurs';

    /**
     * Primārās atslēgas kolonnas nosaukums.
     */
    public $primaryKey = 'AudzeknisNumursID';

    /**
     * Norāda, vai primārā atslēga ir automātiski pieaugoša.
     */
    public $incrementing = false;

    /**
     * Norāda, vai modelim ir atjaunināšanas un izveides laika zīmogi.
     */
    public $timestamps = false;
}
