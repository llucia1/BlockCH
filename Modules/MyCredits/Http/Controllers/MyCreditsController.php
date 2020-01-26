<?php

namespace Modules\MyCredits\Http\Controllers;

use App\Models\CreditsCollection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Config;
use Auth;

class MyCreditsController extends Controller
{
    private $paginate = 0;

    function __construct()
    {
        $this->paginate = Config::get('app.pagesNumber');
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        if( request()->ajax() ) {
            
            $credits = CreditsCollection::where('user_id',Auth::User()->id)
            ->paginate($this->paginate);
            return response()->json($credits);

        }else{
            $totalCreditsGot = CreditsCollection::select('credits')
            ->where('user_id',Auth::User()->id)
            ->sum('credits');
            return view('mycredits::index',compact('totalCreditsGot'));
        }

    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('mycredits::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('mycredits::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('mycredits::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }
}
