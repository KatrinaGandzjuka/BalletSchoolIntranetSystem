<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * PedagogsNumurs_tabula modelis nodrošina pedagogu numuru datu pārvaldību.
 * 
 * Nosaukums: App\Models
 * 
 * Parametri:
 * - $PedagogsNumursID - primārā atslēga
 */
class PedagogsNumurs_tabula extends Model
{
    use HasFactory;

    /**
     * Tabulas nosaukums, kas saistīta ar šo modeli.
     */
    public $table = 'pedagogsnumurs';

    /**
     * Primārās atslēgas kolonnas nosaukums.
     */
    public $primaryKey = 'PedagogsNumursID';

    /**
     * Norāda, vai primārā atslēga ir automātiski pieaugoša.
     */
    public $incrementing = false;

    /**
     * Norāda, vai modelim ir atjaunināšanas un izveides laika zīmogi.
     */
    public $timestamps = false;
}
