<?php

namespace Modules\Users\Http\Controllers;

use App\User;
use UserCrm;
use App\Models\Country;
use App\Models\UserCourse;
use App\Models\Referral;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Users\Http\Requests\UserCreateRequest;
use Modules\Users\Http\Requests\UserEditRequest;
use Illuminate\Support\Facades\Config;
use App\Mail\SendEmail;
use Illuminate\Support\Facades\Mail;
use Bouncer;

class UsersController extends Controller
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

            $users = User::withTrashed()
            ->with('roles')
            ->paginate($this->paginate);
            return response()->json($users);

        }else{

            return view('users::index');
        }
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        //listado de paises
        $countries = Country::all();
        return view('users::create',compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(UserCreateRequest $request)
    {
        //instanciamos la entidad
        $user = new User;
        //pasamos los datos
        $user->name = $request->name;
        $user->email = $request->email;
        //encriptamos la contraseña
        $user->password = bcrypt($request->password);
        //seteamos el resto de datos
        //$user->card_number = $request->card_number;//pendiente de decidir si este dato se queda para encriptar
        $user->country = $request->country;
        $user->city = $request->city;
        $user->address = $request->address;
        $user->prefix = $request->prefix;
        $user->telephone = $request->telephone;
        $user->user_crm = base64_encode($request->email.'_'.$request->password);
        //guardamos el usuario
        $user->save();
        //el usuario se inicia como deshabilitado
        //$user->delete();
        //asignamos el rol
        Bouncer::assign($request->rol)->to($user);
        //enviamos el email para confirmar su cuenta
        //Mail::to($user->email)->send(new SendEmail());
        //creamos las url referral
        Referral::setReferralOwn($user->id);
        //replicamos el usuario en el CRM, pasando el ID de este
        UserCrm::setUserCrm($user->id);
        //devolvemos el usuario creado
        return response()->json($user);
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {

        if( request()->ajax() ) {

            $user = User::withTrashed()
            ->with('roles')->find($id);
            //si usuario es vacío, entonces pasamos un vector con los datos
            //campos igualados a vacío, para el vue.
            if( empty($user) )
                $user = $this->_getDefaultResult();
            //devolvemos user y parseamos json
            return response()->json($user);

        }else{

            $countries = Country::all();
            $user = User::withTrashed()
            ->with('roles')->findOrFail($id);
            return view('users::edit',compact('user','countries'));
        }

    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(UserEditRequest $request,$id)
    {
        //buscamos el usuario desde su id
        $user = User::find($id);
        //editamos los datos
        $user->name = $request->name;
        $user->email = $request->email;
        //si password es distinto de vacío, entonces actualizamos 
        if( $request->password )
            //encriptamos la contraseña
            $user->password = bcrypt($request->password);
        
        //actualizamos el usuario
        $user->save();
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }

    /**
     * disabled or abled this register
     * @return Response
     */
    public function disabled($id)
    {
        if( request()->ajax() ) {
            //obtenemos el usuario
            $user = User::withTrashed()->find($id);
            //comprobamos si el usuario esta o no deshabilitado
            if( $user->deleted_at == null ){
                //disable usuario
                $user->delete();

            }else{
                //able usuario
                $user->restore();
            }
            //actualizamos usuario
            $user->save();
            return response()->json($user);
        }
    }

    /**
     * looking for data from param
     * @return Response
     */
    
    public function search($query)
    {
        $users = User::withTrashed()->with('roles')
        ->whereHas('roles', function ($q) use ($query) {
            $q->where('name', 'LIKE', '%'.$query.'%');
        })
        ->orWhere('name','LIKE','%' . $query . '%')
        ->paginate($this->paginate);
        return response()->json($users);
    }
    
    /**
     * get default object if empty
     * @return Response
     */
    private function _getDefaultResult() 
    {
        $obj =  [
            'user' => '',
            'first_name' => '',
            'last_name' => '',
            'password' => '',
            'email' => '',
            'deleted_at' => null,
            'country' => '',
            'city' => '',
            'address' => '',
            'zip' => '',
            'telephone' => '',
            'prefix' => ''
        ];

        return (object)$obj;
    }

    /**
     * It finish sign up process
     *
     * @return Response
     */
    /*public function endRegister($id) 
    {
        //listado de paises
        $countries = Country::all();
        //comnprobamos si existe mediante el token el usuario
        $user = User::findOrFail($id);
        //mostramos el formulario
        return view('users::endregister',compact('user','countries'));
    }*/

    /**
     * acces point for register
     * @return Response
     */
    public function register($referral = null) 
    {
        //listado de paises
        $countries = Country::all();
        //mostramos el formulario
        return view('users::register',compact('user','countries','referral'));
    }
    /**
     * Store para registro desde la página
     */
    public function registerStore(Request $request) 
    {
        if( request()->ajax() ) {
            
            //instanciamos la entidad
            $user = new User;
            //pasamos los datos
            $user->name = $request->name;
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->city = $request->city;
            $user->country = $request->country;
            $user->prefix = $request->prefix;
            $user->telephone = $request->telephone;
            $user->zip = $request->zip;
            $user->address = $request->address;
            $user->user_crm = base64_encode($request->email.'_'.$request->password);
            //guardamos el usuario
            $user->save();
            //asignamos el rol
            Bouncer::assign('User')->to($user);
            //creamos las url referral
            Referral::setReferralOwn($user->id);
            //replicamos el usuario en el CRM, pasando el ID de este
            UserCrm::setUserCrm($user->id);
            //retornamos el usuario creado
            return response()->json($user);

        }else{

            abort('404');
        }
    }

    public function registerEnd($id = 0)
    {
        if( $id > 0 ) {

            return view('users::register_end');

        }else{
            return redirect('home');
        }
        
    }

    /**
     * Método que elimina un curso de la lista de cursos
     * vinculados al usuario
     */
    public function deleteCourse($idCourse) 
    {
        if( request()->ajax() ) {

            UserCourse::destroy($idCourse);

        }else{

            abort(404);
        }
    }

    /**
     * Vinculamos un curso a un usuario
     */
    public function setCourseToUser($idUser, Request $request)
    {
        if( request()->ajax() ) {

            $userCourse = new UserCourse;
            $userCourse->course_id = $request->courseId;
            $userCourse->user_id = $idUser;
            $userCourse->save();

        }else{

            abort(404);
        }
    }
}
