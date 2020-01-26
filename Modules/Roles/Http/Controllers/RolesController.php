<?php

namespace Modules\Roles\Http\Controllers;

use Silber\Bouncer\Database\Role;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class RolesController extends Controller
{
    private $paginate = 10;

    function __construct()
    {
        $this->paginate = 10;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        if( request()->ajax() ) {

            $roles = Role::paginate($this->paginate);
            return response()->json($roles);

        }else{

            return view('roles::index');
        }
        
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('roles::create');
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
        return view('roles::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('roles::edit');
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

    /**
     * looking for data from param
     * @return Response
     */
    public function search($query)
    {
        $roles = Role::Where('title','LIKE','%' . $query . '%')
        ->paginate($this->paginate);
        return response()->json($roles);
    }
}
