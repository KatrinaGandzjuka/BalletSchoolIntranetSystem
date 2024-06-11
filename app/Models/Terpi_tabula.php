<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Terpi_tabula modelis nodrošina kostīmu datu pārvaldību.
 * 
 * Nosaukums: App\Models
 * 
 * Parametri:
 * - $KostimiID - primārā atslēga
 */
class Terpi_tabula extends Model
{
    use HasFactory;

    /**
     * Tabulas nosaukums, kas saistīta ar šo modeli.
     */
    public $table = 'kostimi';

    /**
     * Primārās atslēgas kolonnas nosaukums.
     */
    public $primaryKey = 'KostimiID';

    /**
     * Norāda, vai primārā atslēga ir automātiski pieaugoša.
     */
    public $incrementing = false;

    /**
     * Norāda, vai modelim ir atjaunināšanas un izveides laika zīmogi.
     */
    public $timestamps = false;
}
