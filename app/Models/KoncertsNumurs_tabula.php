<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * KoncertsNumurs_tabula modelis nodrošina koncerta numuru datu pārvaldību.
 * 
 * Nosaukums: App\Models
 * 
 * Parametri:
 * - $KoncertsNumursID - primārā atslēga
 */
class KoncertsNumurs_tabula extends Model
{
    use HasFactory;

    /**
     * Tabulas nosaukums, kas saistīta ar šo modeli.
     */
    public $table = 'koncertsnumurs';

    /**
     * Primārās atslēgas kolonnas nosaukums.
     */
    public $primaryKey = 'KoncertsNumursID';

    /**
     * Norāda, vai primārā atslēga ir automātiski pieaugoša.
     */
    public $incrementing = true;

    /**
     * Norāda, vai modelim ir atjaunināšanas un izveides laika zīmogi.
     */
    public $timestamps = false;

    /**
     * Masīvs ar aizpildāmajiem laukiem.
     */
    protected $fillable = [
        'KoncertsIDKoncNumurs',
        'KartasNumurs',
        'NumursIDKoncNumurs'
    ];

    /**
     * Attiecība "viens pret daudziem" ar Koncerts_tabula modeli.
     */
    public function koncerts()
    {
        return $this->belongsTo(Koncerts_tabula::class, 'KoncertsIDKoncNumurs', 'KoncertsID');
    }

    /**
     * Attiecība "viens pret daudziem" ar Numurs_tabula modeli.
     */
    public function numurs()
    {
        return $this->belongsTo(Numurs_tabula::class, 'NumursIDKoncNumurs', 'NumursID');
    }
}
