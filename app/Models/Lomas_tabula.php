<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Lomas_tabula modelis nodrošina lomu datu pārvaldību.
 * 
 * Nosaukums: App\Models
 * 
 * Parametri:
 * - $LomaID - primārā atslēga
 */
class Lomas_tabula extends Model
{
    use HasFactory;

    /**
     * Tabulas nosaukums, kas saistīta ar šo modeli.
     */
    public $table = 'loma';

    /**
     * Primārās atslēgas kolonnas nosaukums.
     */
    public $primaryKey = 'LomaID';

    /**
     * Norāda, vai primārā atslēga ir automātiski pieaugoša.
     */
    public $incrementing = false;

    /**
     * Norāda, vai modelim ir atjaunināšanas un izveides laika zīmogi.
     */
    public $timestamps = false;
}
