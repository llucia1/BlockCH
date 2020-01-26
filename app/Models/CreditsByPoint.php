<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CreditsByPoint extends Model
{
    public $timestamps = false;
    public $updated_at = false;
    protected $fillable = ['credits'];

    //método que retorna el total de créditos obtenidos desde la acción
    static function getCredits($concept)
    {
        //almacenamos el total de creditos obtenidos para retornarlos
        $totalCredits = 0;
        //obtenemos los créditos por puntos
        $credits = CreditsByPoint::first();
        //obtenenos los puntos por concepto
        $points = PointsByConcept::where('concept',$concept)->firstOrFail();
        //realizamos el calculo
        $totalCredits = $credits->credit*$points->point;

        return $totalCredits;
    }
}
