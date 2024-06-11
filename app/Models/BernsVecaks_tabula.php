<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * BernsVecaks_tabula modelis nodrošina bērnu un vecāku attiecību datu pārvaldību.
 * 
 * Nosaukums: App\Models
 * 
 * Parametri:
 * - $BernsVecaksID - primārā atslēga
 */
class BernsVecaks_tabula extends Model
{
    use HasFactory;
    
    /**
     * Tabulas nosaukums, kas saistīta ar šo modeli.
     */
    public $table = 'bernsvecaks';

    /**
     * Primārās atslēgas kolonnas nosaukums.
     */
    public $primaryKey = 'BernsVecaksID';

    /**
     * Norāda, vai primārā atslēga ir automātiski pieaugoša.
     */
    public $incrementing = false;

    /**
     * Norāda, vai modelim ir atjaunināšanas un izveides laika zīmogi.
     */
    public $timestamps = false;
}
