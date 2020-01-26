<?php
namespace App\Helpers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Models\UserCrm;

class UserCrmService
{
	/**
	 * Lo que hacemos aquí es obtener los datos del usuario mediante su ID, recien creado
	 * Con estos datos , creamos un usuario para el CRM, de en principio de tipo Teleoperador
	 * NOTA: hay que ver como hacemos lo de los roles************************************
	 */
    public static function setUserCrm($userId)
	{
		//$user = DB::table('users')->findOrFail($userId);
		//obtenemos los datos de usuario
		$user = User::find($userId);
		//Instanciamos UserCrm
		$userCrm = new UserCrm;
		//seteamos los datos para crear el nuevo, usuario para el CRM
		$userCrm->idRol = 4;
		$userCrm->nombre = $user->name;
		$userCrm->apellidos = $user->first_name.' '.$user->second_name;
		$userCrm->email = $user->email;
		$userCrm->pass = $user->password;
		$userCrm->save();
		return $userCrm;

	}

	public static function getUserCrm()
	{
		//alamcenamos el email y el pass separado por _
		$tokenCrm = null;
		$user = User::find(Auth::id());
		$tokenCrm = $user->user_crm;
		return $tokenCrm;
	}
}