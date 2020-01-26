<?php

namespace Modules\Referrals\Http\Controllers;

use App\Models\Referral;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Referrals\Http\Requests\ReferralCreateRequest;
use Modules\Referrals\Http\Requests\ReferralEditRequest;
use Illuminate\Support\Facades\Config;
use Auth;

class ReferralsController extends Controller
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
            /**
             * consultamos el rol de usuario, si es de tipo User
             * Obtenemos sus referidos, en caso de ser de tipo
             * Admin, la consutla es abierta
             */
            if( Auth::User()->isA('User') ) {
                $referrals = Referral::with('user')
                ->where('user_id',Auth::User()->id)
                ->paginate($this->paginate);
            }else{
                $referrals = Referral::with('user')->paginate($this->paginate);
            }
            
            return response()->json($referrals);

        }else{

            return view('referrals::index');
        }
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(Request $request)
    {
        return view('referrals::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(ReferralCreateRequest $request)
    {
        //instanciamos la entidad
        $referral = new Referral;
        //pasamos los datos
        $referral->user_id = $request->user()->id;
        $referral->url = $request->url;
        //guardamos el link referral
        $referral->save();
        //devolvemos el link referral creado
        return response()->json($referral);
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('referrals::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        $referral = Referral::find($id);

        if( request()->ajax() ) {

            //si referrals es vacío, entonces pasamos un vector con los datos
            //campos igualados a vacío, para el vue.
            if( empty($referral) )
                $referral = $this->_getDefaultResult();
            //devolvemos referrals y parseamos json
            return response()->json($referral);

        }else{

            return view('referrals::edit',compact('referral'));
        }
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(ReferralEditRequest $request,$id)
    {
        //buscamos el referral desde su id
        $referral = Referral::find($id);
        //editamos los datos
        $referral->url = $request->url;
        //actualizamos el referral
        $referral->save();
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }
    /**
     * looking for data from param
     * @return Response
     */
    public function search($query)
    {
        $referral = Referral::with('user')
        ->whereHas('user', function ($q) use ($query) {
            $q->where('name', 'LIKE', '%'.$query.'%');
        })
        ->paginate($this->paginate);
        return response()->json($referral);
    }

    /**
     * get default object if empty
     * @return Response
     */
    private function _getDefaultResult() 
    {
        $obj =  [
            'url' => '',
        ];

        return (object)$obj;
    }
}
