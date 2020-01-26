<?php

namespace Modules\Support\Http\Controllers;

use App\Models\Support;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Config;
use Auth;

class SupportController extends Controller
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
    public function index($state = 1)
    {
        if( request()->ajax() ) {
            /**
             * consultamos el rol de usuario, si es de tipo User
             * Obtenemos sus tikects, en caso de ser de tipo
             * Admin, la consutla es abierta
             */
            if( Auth::User()->isA('User') ) {
                $supports = Support::where('from_id',Auth::User()->id)
                ->where('parent',0)
                ->where('state',$state)
                ->paginate($this->paginate);
            }else{
                $supports = Support::where('parent',0)
                ->where('state',$state)
                ->paginate($this->paginate);
            }
            
            return response()->json($supports);

        }else{

            return view('support::index');
        }
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('support::create');
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
        return view('support::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        return view('support::edit',compact('id'));
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
