<?php

namespace Modules\Courses\Http\Controllers;

use App\Models\CourseChapter;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;

class ChapterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        if( request()->ajax() ) {
            
            $chapters = Course::find($id)->chapters;
            return response()->json($chapters);
            
        }else{

            abort(404);
        }; 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id,Request $request)
    {
        if( request()->ajax() ) {

            $chapter = new CourseChapter;
            //seteamos los datos
            $chapter->course_id = $id;
            $chapter->name = $request->name;
            $chapter->text = $request->text;
            $chapter->video = $request->video;
            //guardamos
            $chapter->save();
            //devolvemos el item creado
            return response()->json($chapter);

        }else{

            abort(404);
        };

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Chapter  $chapter
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if( request()->ajax() ) {
            //consultamos mediante el id, si existe o no el item
            $chapter = CourseChapter::find($id);
            //si no existe, entocnes llamamos al método privado _getDefaultResult que devolvera un objeto con los datos empty
            if( empty($chapter) )
                $chapter = $this->_getDefaultResult();

            return response()->json($chapter);

        }else{

            abort(404);
        }

    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update($id, Request $request)
    {
        if( request()->ajax() ) {

            $chapter = CourseChapter::findOrFail($id);
            //seteamos los datos
            $chapter->name = $request->name;
            $chapter->text = $request->text;
            $chapter->video = $request->video;
            //guardamos
            $chapter->save();
            //devolvemos el item creado
            return response()->json($chapter);

        }else{

            abort(404);
        };
    }
    //método para subir documentos y archivos
    public function setFile( $id, Request $request ){

        if( request()->ajax() ) {

            //comprobamos si el campo contiene o no un archivo
            if( $request->file('attached') ) {
                //obtenemos el item
                $document = CourseChapter::find($id);
                //llamamos a _deleteFile para que en caso de existir docuemtno antiguo al editar elimine el otro y no dejar basura en la carpeta
                $this->_deleteFile($document);
                //almacenamos el documento
                $doc = $request->file('attached');
                $docname = time() . '.' . $doc->getClientOriginalExtension();
                $doc->storeAs('documents', $docname);
                //seteamos y guardamos
                $document->update([ 'attached' => $docname]);
                //devolvemos el item
                return response()->json($document);
            }

        }else{
            
            abort(404);
        }
    }

     /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        if( request()->ajax() ) {
            //Localizamos el item
            $chapter = CourseChapter::find($id);
            //borramos el documento de la carpeta
            $this->_deleteFile($chapter);
            //Booramos el item
            $chapter->delete();
            
        }else{
                
            abort(404);
        }
    }

    //método privado, borra si existe el documento de la carpeta
    private function _deleteFile($file)
    {
        //borramos el documento de la carpeta
        Storage::delete('documents/'.$file->attached);
    }

    /**
     * get default object if empty
     * @return Response
     */
    private function _getDefaultResult() 
    {
        $obj =  [
            
            'course_id' => 0,
            'name' => '',
            'video' => '',
            'text ' => '',
            'attached ' => '',
        ];
        return (object)$obj;
    }

}
