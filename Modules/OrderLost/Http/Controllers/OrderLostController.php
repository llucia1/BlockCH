<?php

namespace Modules\OrderLost\Http\Controllers;

use App\Models\OrderLost;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Config;

class OrderLostController extends Controller
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

            $orders = OrderLost::paginate($this->paginate);
            return response()->json($orders);

        }else{

            return view('orderlost::index');
        }
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('orderlost::create');
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
        return view('orderlost::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('orderlost::edit');
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
