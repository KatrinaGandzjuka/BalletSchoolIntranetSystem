<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * AudzeknisGrupa_tabula modelis nodrošina audzēkņu un grupu attiecību datu pārvaldību.
 * 
 * Nosaukums: App\Models
 * 
 * Parametri:
 * - $AudzeknisGrupaID - primārā atslēga
 */
class AudzeknisGrupa_tabula extends Model
{
    use HasFactory;
    
    /**
     * Tabulas nosaukums, kas saistīta ar šo modeli.
     */
    public $table = 'audzeknisgrupa';

    /**
     * Primārās atslēgas kolonnas nosaukums.
     */
    public $primaryKey = 'AudzeknisGrupaID';

    /**
     * Norāda, vai primārā atslēga ir automātiski pieaugoša.
     */
    public $incrementing = false;

    /**
     * Norāda, vai modelim ir atjaunināšanas un izveides laika zīmogi.
     */
    public $timestamps = false;
}
