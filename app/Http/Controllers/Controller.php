<?php
//note to self: laravel controller ir klase, kas nodrošina iespēju apstrādāt lietotāja pieprasījumus, kas saistīti ar Laravel tīmekļa lietojumprogrammu. Tie parasti satur  vairākas metodes, kas atbild par dažādiem pieprasījumiem un ir izmantotilai atdalītu lietotāja saskarnes koda loģiku no citas sistēmas loģikas, kas varētu būt saistīta ar datu apstrādi, datu bāzēm, e-pastiem un citiem procesiem. 
namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
