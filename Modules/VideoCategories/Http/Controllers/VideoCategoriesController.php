<?php

namespace Modules\VideoCategories\Http\Controllers;

use App\Models\VideoCategory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\VideoCategories\Http\Requests\VideoCategoryCreateRequest;
use Modules\VideoCategories\Http\Requests\VideoCategoryEditRequest;
use Illuminate\Support\Facades\Config;
use Illuminate\Routing\Controller;

class VideoCategoriesController extends Controller
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

            $categories = VideoCategory::paginate($this->paginate);
            return response()->json($categories);

        }else{

            return view('videocategories::index');
        }
        
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('videocategories::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(VideoCategoryCreateRequest $request)
    {
        //instanciamos la entidad
        $videoCategory = new VideoCategory;
        //pasamos los datos
        $videoCategory->name = $request->name;
        //guardamos la categoría
        $videoCategory->save();
        //devolvemos el link referral creado
        return response()->json($videoCategory);
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('videocategories::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        $videoCategory = VideoCategory::findOrFail($id);

        if( request()->ajax() ) {

            //si videoCategory es vacío, entonces pasamos un vector con los datos
            //campos igualados a vacío, para el vue.
            if( empty($videoCategory) )
                $videoCategory = $this->_getDefaultResult();
            //devolvemos videoCategory y parseamos json
            return response()->json($videoCategory);

        }else{

            return view('videocategories::edit',compact('videoCategory'));
        }
        
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(VideoCategoryEditRequest $request,$id)
    {
        //buscamos el usuario desde su id
        $videoCategory = VideoCategory::find($id);
        //editamos los datos
        $videoCategory->name = $request->name;
        //actualizamos la categoría
        $videoCategory->save();
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
        $categories = VideoCategory::Where('name','LIKE','%' . $query . '%')
        ->paginate($this->paginate);
        return response()->json($categories);
    }
    /**
     * get default object if empty
     * @return Response
     */
    private function _getDefaultResult() 
    {
        $obj =  [
            'name' => '',
        ];

        return (object)$obj;
    }
}
