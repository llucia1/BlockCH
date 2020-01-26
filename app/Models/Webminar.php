<?php

namespace App\Models;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;

class Webminar extends Model
{
    protected $dates = ['start'];

    // Mutators
    public function setStartAttribute($value)
    {
        $this->attributes['start'] = Carbon::createFromFormat('d/m/Y', $value);
    }

    // Accesors
    public function getStartAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }


}
