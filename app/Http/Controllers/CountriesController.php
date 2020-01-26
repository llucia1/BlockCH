<?php

namespace App\Http\Controllers;
use App\Models\Country;

use Illuminate\Http\Request;

class CountriesController extends Controller
{
    public function getPrefixByCountry(Request $request)
    {
        if( request()->ajax() ) {

            $prefix = Country::select('prefix')
            ->where('name', 'LIKE', '%'.$request->input('country').'%')
            ->first();
            //devolvemos el resultado
            return response()->json($prefix);

        }else{

            abort(404);
        }

    }
}
