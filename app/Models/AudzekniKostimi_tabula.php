<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * AudzekniKostimi_tabula modelis nodrošina audzēkņu un kostīmu attiecību datu pārvaldību.
 * 
 * Nosaukums: App\Models
 * 
 * Parametri:
 * - $AudzKostID - primārā atslēga
 */
class AudzekniKostimi_tabula extends Model
{
    use HasFactory;
    
    /**
     * Tabulas nosaukums, kas saistīta ar šo modeli.
     */
    public $table = 'audzeknikostimi';

    /**
     * Primārās atslēgas kolonnas nosaukums.
     */
    public $primaryKey = 'AudzKostID';

    /**
     * Norāda, vai primārā atslēga ir automātiski pieaugoša.
     */
    public $incrementing = false;

    /**
     * Norāda, vai modelim ir atjaunināšanas un izveides laika zīmogi.
     */
    public $timestamps = false;
}
