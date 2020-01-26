<?php

namespace Modules\Videos\Http\Controllers;

use App\Models\Video;
use App\Models\VideoCategory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Videos\Http\Requests\VideoCreateRequest;
use Modules\Videos\Http\Requests\VideoEditRequest;
use Illuminate\Support\Facades\Config;
use Illuminate\Routing\Controller;

class VideosController extends Controller
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

            $videos = Video::paginate($this->paginate);
            return response()->json($videos);

        }else{

            return view('videos::index');
        }
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $videosCategories = VideoCategory::all();
        return view('videos::create',compact('videosCategories'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(VideoCreateRequest $request)
    {
        //instanciamos la entidad
        $video = new Video;
        //obtenemos la categoría seleccionada
        $videoCategory = VideoCategory::findOrFail($request->video_category_id);
        //pasamos los datos
        $video->video_category_id = $videoCategory->id;
        $video->name = $request->name;
        $video->code = $request->code;
        $video->category_name = $videoCategory->name;
        //guardamos la categoría
        $video->save();
        //devolvemos el link referral creado
        return response()->json($video);
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        //obtenemos la colección de todos los vídeos
        $videos = Video::all();
        //los pasamos a la vista
        return view('videos::show',compact('videos'));
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        $video = Video::findOrFail($id);
        if( request()->ajax() ) {

            //si video es vacío, entonces pasamos un vector con los datos
            //campos igualados a vacío, para el vue.
            if( empty($video) )
                $video = $this->_getDefaultResult();
            //devolvemos videoCategory y parseamos json
            return response()->json($video);

        }else{

            $videosCategories = VideoCategory::all();
            return view('videos::edit',compact('video','videosCategories'));
        }
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(VideoEditRequest $request,$id)
    {
        $video = Video::find($id);
        //obtenemos la categoría seleccionada
        $videoCategory = VideoCategory::findOrFail($request->video_category_id);
        //pasamos los datos
        $video->video_category_id = $videoCategory->id;
        $video->name = $request->name;
        $video->code = $request->code;
        $video->category_name = $videoCategory->name;
        //guardamos la categoría
        $video->save();
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
        $videos = Video::Where('name','LIKE','%' . $query . '%')
        ->orWhere('category_name','LIKE','%' . $query . '%')
        ->paginate($this->paginate);
        return response()->json($videos);
    }
}
