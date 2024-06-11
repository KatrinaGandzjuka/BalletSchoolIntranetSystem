<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * PedagogsGrupa_tabula modelis nodrošina pedagogu grupu datu pārvaldību.
 * 
 * Nosaukums: App\Models
 * 
 * Parametri:
 * - $PedagogsGrupaID - primārā atslēga
 */
class PedagogsGrupa_tabula extends Model
{
    use HasFactory;

    /**
     * Tabulas nosaukums, kas saistīta ar šo modeli.
     */
    public $table = 'pedagogsgrupa';

    /**
     * Primārās atslēgas kolonnas nosaukums.
     */
    public $primaryKey = 'PedagogsGrupaID';

    /**
     * Norāda, vai primārā atslēga ir automātiski pieaugoša.
     */
    public $incrementing = false;

    /**
     * Norāda, vai modelim ir atjaunināšanas un izveides laika zīmogi.
     */
    public $timestamps = false;
}
